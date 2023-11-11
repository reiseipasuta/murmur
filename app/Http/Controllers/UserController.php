<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    public function myTweets()
    {
        // $myTweets = DB::table('tweets')->where('user_id', '=', Auth::id())->get();
        // クエリビルダ（DB::）は基本的に使わずEloquent推奨

        $myTweets = Tweet::where('user_id', Auth::id())->get();

        return view('myTweets')
            ->with(['myTweets' => $myTweets]);
    }

    public function myPage() {
        $myTweets = Tweet::where('user_id', Auth::id())->withCount('comments', 'likes')->latest()->get();
        $user = User::where('id', Auth::id())->withcount('followings', 'followers')->first();

        return view('myPage', compact('myTweets', 'user'));
        // return $myTweets;
    }

    public function userPage(User $user) {
        if($user->id != Auth::id()){
            $userTweets = Tweet::where('user_id', $user->id)->withCount('comments', 'likes')->get();

            $follower = $user->followers()->where('following_id', Auth::id())->exists();

            $user = User::where('id', $user->id)->withCount('followings', 'followers')->first();

            return view('userPage', compact('userTweets', 'user', 'follower'));
            // return $user;
        }
        else{
            return redirect()->route('index');
        }
    }

    public function profileEditPage(User $user) {
        $user->checkUser($user);
        return view('profileEdit', compact('user'));
    }

    public function profileEdit(User $user, Request $request) {
        // $update = $request->all();
        $user->checkUser($user);

        if($request->image != null) {
            $imagePath = $request->image->store('public/images');
            $imageName = basename($imagePath);
            $user->name = $request->name;
            $user->profile = $request->profile;
            $user->image = $imageName;
            $user->save();
        }
        else{
            $user->name = $request->name;
            $user->profile = $request->profile;
            $user->save();
        }


        return redirect()->route('myPage');
    }

    public function passwordEditPage(User $user) {

        $user->checkUser($user);

        return view('passwordEdit', compact('user'));
    }

    public function passwordEdit(User $user, ProfileUpdateRequest $request) {

        $user->checkUser($user);

        if(password_verify($request->oldPassword,$user->password)){
            if($request->password == $request->password_confirmation){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                return redirect()->route('myPage');
            }else{
                return redirect()->route('passwordEditPage', $user)->with('check', '確認用パスワードが異なっています。');
            }
        }else{
            return redirect()->route('passwordEditPage', $user)->with('warning', 'パスワードが違います。');
        }
    }

    public function emailEditPage(User $user) {

        $user->checkUser($user);
        return view('emailEdit', compact('user'));
    }

    public function emailEdit(User $user, ProfileUpdateRequest $request) {

        $user->checkUser($user);

        if(password_verify($request->password,$user->password)){
            if($request->email == $request->email_confirmation){
                $user->update([
                    'email' => $request->email,
                ]);
                return redirect()->route('myPage');
            }else{
                return redirect()->route('emailEditPage', $user)->with('check', '確認用メールアドレスが異なっています。');
            }
        }else{
            return redirect()->route('emailEditPage', $user)->with('warning', 'パスワードが違います。');
        }
    }

    public function followStore(User $user) {
        $user->followers()->attach(Auth::id());
        return redirect()->route('userPage', $user);
    }

    public function followDestroy(User $user) {
        $user->followers()->detach(Auth::id());
        return redirect()->route('userPage', $user);
    }

    public function followingList(User $user) {
        $follows = $user->followings()->latest()->paginate(10);
        $title = 'フォロー';
        return view('followList', compact('user', 'follows', 'title'));

    }

    public function followerList(User $user) {
        $follows = $user->followers()->latest()->paginate(10);
        $title = 'フォロワー';
        return view('followList', compact('user', 'follows', 'title'));
    }

    public function register() {
        return view('userRegister');
    }

    // public function store(Request $request) {
    //     $user = new User();
    //     $user->create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'profile' => $request->profile,
    //         'image' => $request->image,
    //     ]);

    //     return view('myPage', compact('user'));
    // }

    public function destroy(User $user) {
        $user->checkUser($user);
        $user->delete();
        return view('index');
    }

    public function edit(User $user) {
        $user->checkUser($user);
        return view('edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $user->checkUser($user);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'profile' => $request->profile,
            'image' => $request->image,
        ]);

        return view('myPage', compact('user'));
    }

    public function goodList(User $user)
    {
        $user->checkUser($user);
        $tweets = $user->likes()->latest()->paginate(10);
        return view('goodList', compact('tweets'));
    }

    public function guestLogin()
    {
        Auth::loginUsingId(6);
        return redirect()->route('index');
    }

}
