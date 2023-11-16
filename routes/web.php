<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TweetController::class, 'index'])->name('index');
Route::get('tweet/{tweet}/comment/create', [CommentController::class, 'createComment'])->name('createComment');
Route::get('{user}/userPage', [UserController::class, 'userPage'])->name('userPage');
Route::get('guest', [UserController::class, 'guestLogin'])->name('guestLogin');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('tweet/create', [TweetController::class, 'create'])->name('create');
    Route::post('tweet', [TweetController::class, 'store'])->name('store');
    Route::patch('tweet/{tweet}', [TweetController::class, 'update'])->name('update');
    Route::get('tweet/{tweet}/edit', [TweetController::class, 'edit'])->name('edit');
    Route::delete('tweet/{tweet}', [TweetController::class, 'destroy'])->name('destroy');

    Route::get('tweet/{id}/list', [TweetController::class, 'list'])->name('list');

    // Route::get('tweet/{tweet}/comment/', function(App\Models\Tweet $tweet) { return $tweet; })->name('storeComment');
    Route::post('tweet/{tweet}/comment/', [CommentController::class, 'storeComment'])->name('storeComment');
    Route::patch('tweet/{tweet}/{comment}/', [CommentController::class, 'updateComment'])->name('updateComment');
    Route::get('tweet/{tweet}/{comment}/edit', [CommentController::class, 'editComment'])->name('editComment');
    Route::delete('tweet/{tweet}/{comment}/', [CommentController::class, 'destroyComment'])->name('destroyComment');

    // Route::get('tweet/myTweets', [UserController::class, 'myTweets'])->name('myTweets');
    Route::get('myPage', [UserController::class, 'myPage'])->name('myPage');
    Route::get('{user}/profileEditPage', [UserController::class, 'profileEditPage'])->name('profileEditPage');
    Route::patch('{user}/profileEdit', [UserController::class, 'profileEdit'])->name('profileEdit');

    Route::post('{user}/userPage/store', [UserController::class, 'followStore'])->name('followStore');
    Route::delete('{user}/userPage/destroy', [UserController::class, 'followDestroy'])->name('followDestroy');

    Route::post('register', [UserController::class, 'store'])->name('storeUser');
    Route::patch('user/{user}', [UserController::class, 'update'])->name('updateUser');
    Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('editUser');
    Route::delete('user/destroy', [UserController::class, 'destroy'])->name('destroyUser');
    Route::get('user/{user}/email', [UserController::class, 'emailEditPage'])->name('emailEditPage');
    Route::patch('user/{user}/email', [UserController::class, 'emailEdit'])->name('emailEdit');
    Route::get('user/{user}/password', [UserController::class, 'passwordEditPage'])->name('passwordEditPage');
    Route::patch('user/{user}/password', [UserController::class, 'passwordEdit'])->name('passwordEdit');

    Route::get('user/{user}/following', [UserController::class, 'followingList'])->name('followingList');
    Route::get('user/{user}/follower', [UserController::class, 'followerList'])->name('followerList');
    Route::get('user/{user}/goodList', [UserController::class, 'goodList'])->name('goodList');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('tweet/{tweet}/like', [LikeController::class, 'likeChange'])->name('likeChange');



});

require __DIR__.'/auth.php';
