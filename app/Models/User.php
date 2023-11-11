<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 書籍マスタ
 *
 * @property integer $book_id
 * @property string $book_title
 * @property integer $author_id
 * @property \Illuminate\Support\Carbon $published_date
 * @property \Illuminate\Support\Carbon $created_at
 * @property integer $created_by
 * @property \Illuminate\Support\Carbon $updated_at
 * @property integer $updated_by
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property integer $deleted_by
 */


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'image'
    ];

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'tweet_user');
    }

    public function isLike($post)
    {
        return $this->likes()->where('post_id', $post)->exists();
    }

    public function likeChange($post)
    {
        if($this->isLike($post)){
            $this->likes()->detach($post);
        }else{
            $this->likes()->attach($post);
        }
    }

    public function checkUser($user)
    {
        if(Auth::id() != $user->id)
        {
           abort(403);
        }
    }

    public function getProfileLinkAttribute(): string
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target=”_blank”>$1</a>';
        return preg_replace($pattern, $replace, $this->profile);
    }





    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
