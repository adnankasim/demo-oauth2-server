<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
});

Route::get('tes', function () {
    // $users = User::select('id','name')->paginate(5);
    // $users = User::select('id','name')->simplePaginate(5);
    $users = User::select('id','name')->cursorPaginate(5);
    return $users;
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
