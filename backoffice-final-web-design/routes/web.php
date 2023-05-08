<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'signIn'])->name('accounts_sign_in');
Route::post('/accounts/sign-in', [AuthController::class, 'processAuthentication'])->name('accounts.authenticate');
Route::get('/articles/new', [ArticleController::class, 'create_article'])->name('new_article');
Route::post('/articles/save', [ArticleController::class, 'save_article'])->name('save_article');
Route::get('/articles/{slug}', [ArticleController::class, 'details_article'])->name('article_details');
Route::get('/articles', [ArticleController::class, 'list_articles'])->name('article_list');
