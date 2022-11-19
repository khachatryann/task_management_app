<?php

use App\Http\Controllers\Adminka\AdminController;
use App\Http\Controllers\Task\Task_Search\SearchController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\HomeController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [RegisterController::class, 'welcome']);

    //Auth
    Route::get('/register', [RegisterController::class, 'register_view'])->name('register_view');
    Route::post('/register/store', [RegisterController::class, 'register'])->name('register');
    Route::get('/login', [LoginController::class, 'login_view'])->name('login_view');
    Route::post('/login/store', [LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    //PROFILE
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/profile', [HomeController::class, 'profile_view'])->name('profile_view');
    Route::get('/delete/{id}', [AdminController::class, 'delete_user'])->name('delete_user');

    //Account Delete
    Route::get('/home/delete', [HomeController::class, 'delete_view'])->name('delete_view');
    Route::get('/home/delete/{id}', [HomeController::class, 'delete'])->name('delete');

    //Tasks
    Route::resource('tasks', TaskController::class);

    //Search
    Route::get('/task/search/', [SearchController::class, 'index'])->name('task_search');
    Route::get('/user/search/', [AdminController::class, 'search_user'])->name('user_search');

    //only auth->programmer task
    Route::get('/selected/tasks', [TaskController::class, 'prg_tasks'])->name('programmer_tasks');

});


