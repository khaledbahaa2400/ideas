<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('explore', [DashboardController::class, 'explore'])->name('explore')->middleware('auth');

Route::get('feed', [DashboardController::class, 'feed'])->name('feed')->middleware('auth');

Route::view('terms', 'terms')->name('terms');

Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');

Route::resource('ideas', IdeaController::class)->only(['show']);

Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show', 'update', 'edit']);

Route::view('register', "auth.register")->name('register')->middleware('guest');

Route::post('register', [UserController::class, 'store']);

Route::view('login', "auth.login")->name('login')->middleware('guest');

Route::post('login', [UserController::class, 'authenticate']);

Route::match(['get', 'post'], 'logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('users.{user}.follow', [UserController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('users.{user}.unfollow', [UserController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::post('ideas.{idea}.like', [UserController::class, 'like'])->name('ideas.like')->middleware('auth');
Route::post('ideas.{idea}.unlike', [UserController::class, 'unlike'])->name('ideas.unlike')->middleware('auth');
