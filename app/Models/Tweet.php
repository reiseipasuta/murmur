<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'tweet_user');
    }

    public function isLike($user)
    {
        return $this->likes()->where('user_id', $user)->exists();
    }

    public function likeChange($user)
    {
        if($this->isLike($user)){
            $this->likes()->detach($user);
        }else{
            $this->likes()->attach($user);
        }
    }

    public function getBodyLinkAttribute(): string
    {
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target=”_blank”>$1</a>';
        return preg_replace($pattern, $replace, $this->body);
    }

    public function getImageOrVideo($image)
    {
        if($image != null){

            $file = pathinfo($image);
            $filetype = $file['extension'];
            // return $filetype;

            if($filetype == 'jpg'||'png'||'gif'){
                return true;
            }elseif($filetype == 'mov'||'heif'||'mp4'||'MP4'||'HEIF'||'MOV'){
                return false;
            }else{
                ;
            }
        }else{
            ;
        }
    }

}
