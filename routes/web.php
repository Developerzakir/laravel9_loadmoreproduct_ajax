<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('/load-more-data', [PostController::class,'loadMoreData'])->name('load.more');

Route::get('/', function () {
    return view('welcome');
});
