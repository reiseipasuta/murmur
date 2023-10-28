<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function likeChange(Tweet $tweet)
    {
        $tweet->likeChange(Auth::id());
        return Redirect::back();
    }
}
