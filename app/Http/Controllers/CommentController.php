<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TweetRequest;

class CommentController extends Controller
{
    public function createComment(Tweet $tweet)
    {
        $comments = $tweet->comments()->with('user')->get();
        return view('tweet.createComment', compact('tweet', 'comments'));
        // return $comments;
    }

    public function storeComment(Tweet $tweet, TweetRequest $request)
    {
        $comment = new Comment();
        $comment->create([
            'body' => $request->body,
            'tweet_id' => $tweet->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('createComment', $tweet);
    }

    public function editComment(Tweet $tweet, Comment $comment)
    {
        if(Auth::id() != $comment->user_id)
        {
            abort(403);
        }

        return view('tweet.editComment', compact('tweet', 'comment'));
    }

    public function updateComment(TweetRequest $request, Tweet $tweet, Comment $comment)
    {
        $comment->body = $request->body;
        $comment->save();

        return redirect()
            ->route('createComment', compact('tweet', 'comment'));

    }

    public function destroyComment(Tweet $tweet, Comment $comment)
    {
        $comment->delete();

        return redirect()
            ->route('createComment', $tweet);
    }



}
