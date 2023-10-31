<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TweetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    // public function iiindex ()
    // {
    //     // $tweets = Tweet::latest()->get();
    //     // $tweets = Tweet::withCount('comments')->with('user','comments')->latest()->get();
    //     $tweets =  Tweet::withCount('comments', 'likes')->with('user','comments')->latest()->paginate(5);
    //     $user = Auth::user();
    //     // return $user;
    //     return view('iiindex', compact('tweets', 'user'));
    // }

    public function index (Request $request)
    {
        $keyword = $request->keyword;

        $query = Tweet::query();

        if(!empty($keyword))
        {
            $spaceConversion = mb_convert_kana($keyword, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArraySearched as $value)
            {
                $slashValue = '%'. addcslashes($value, '%_\\'). '%';
                $query->where('body','LIKE', $slashValue);
            }
            $tweets = $query->with('user','comments')->withCount('comments', 'likes')->latest()->paginate(5);
        }else{
            $tweets = $query->withCount('comments', 'likes')->with('user','comments')->latest()->paginate(5);
        }

        return view('index', compact('tweets','keyword'));

    }

    public function create()
    {
        return view('tweet.create');
    }

    public function store(TweetRequest $request)
    {
        $tweet = new Tweet();

        if($request->image != null)
        {
            $imagePath = $request->image->store('public/tweetImages');
            $imageName = basename($imagePath);
            $tweet->create([
                'body' => $request->body,
                'user_id' => Auth::id(),
                'image' => $imageName,
            ]);
        }else{
            $tweet->create([
                'body' => $request->body,
                'user_id' => Auth::id(),
                'image' => null,
            ]);
        }


        return redirect()
            ->route('index');
    }

    public function edit(Tweet $tweet)
    {
        if(Auth::id() != $tweet->user_id)
        {
            abort(403);
        }

        return view('tweet.edit')
            ->with(['tweet' => $tweet]);
    }

    public function update(TweetRequest $request, Tweet $tweet)
    {
        $tweet->body = $request->body;
        $tweet->save();

        return redirect()
            ->route('index');

    }

    public function destroy(Tweet $tweet)
    {
        if($tweet->image != null){
            Storage::delete($tweet->image);
        }
        $tweet->delete();

        return redirect()
            ->route('index');
    }

    public function userPage(User $user) {
        $userTweets = Tweet::where('user_id', $user->id)->withCount('comments')->get();
        // $user = User::find(Auth::id());

        return view('userPage', compact('userTweets', 'user'));
    }



    public function list($id)
    {
        // \DB::enableQueryLog();
        // $tweets = Tweet::where('user_id', $id)->with('user')->get();
        // foreach ($tweets as $tweet) {
        //     echo $tweet->user->name;
        // }
        // dd(\DB::getQueryLog());

        // \DB::enableQueryLog();
        // $user = User::find($id)->with('tweets')->get();
        // foreach ($user as $tweet) {
        //     echo $tweet->tweets;
        // }
        // echo $user;
        // dd(\DB::getQueryLog());

        $user = User::find($id);
        $tweets = Tweet::where('user_id', $id)->get();
        return view('tweet.list', compact('user', 'tweets'));
    }


}
