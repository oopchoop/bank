<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\CardsTypeController;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\CreditsTypeController;
use App\Http\Controllers\CsrfController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersCardsController;
use App\Http\Controllers\UsersCreditsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/admin', function ()
{
   if(empty(Auth::user())) return redirect('/auth');
   else if(Auth::user()->isAdmin) return redirect('/');
   else return redirect('/admin');
});

Route::post('/registration', [UserController::class, 'reg_post']);
Route::post('/authorization', [UserController::class, 'auth_post']);

Route::get('/getAuthStatus', [UserController::class, 'getAuthStatus']);
Route::get('/logout', [UserController::class, 'logOut']);

Route::get('/getCredits', [CreditsController::class, 'getCredits']);
Route::get('/getCards', [CardsController::class, 'getCards']);

Route::get('/getUserCards', [UsersCardsController::class, 'getUserCards']);
Route::get('/getUserCredits', [UsersCreditsController::class, 'getCreditsToUser']);

Route::get('/getCardsFromId/{id}', [CardsController::class, 'getCardsFromId']);
Route::get('/addCardToUser/{id}', [UsersCardsController::class, 'addCardToUser']);

Route::get('/getCreditFromId/{id}', [CreditsController::class, 'getCreditFromId']);
Route::post('/addCredit', [UsersCreditsController::class, 'addStroke']);

Route::get('/getPost/{id}', [NewsController::class, 'getNewsFromId']);
Route::get('/getNews', [NewsController::class, 'getNews']);

Route::get('/getCreditTypes', [CreditsTypeController::class, 'getCreditTypes']);
Route::get('/getCardsType', array(CardsTypeController::class, 'getCardsType'));

Route::get('/deleteCredit/{id}', [CreditsController::class, 'deleteCredit']);

Route::post('/updateCredit', [CreditsController::class, 'updateCredit']);
Route::post('/addNewCredit', [CreditsController::class, 'addNewCredit']);

Route::get('/deleteCard/{id}', [CardsController::class, 'deleteCard']);
Route::post('/addNewCard', [CardsController::class, 'addNewCard']);
Route::post('/updateCard', [CardsController::class, 'updateCard']);

Route::get('{any?}', fn() => view('app'))
    ->where('any', '.*');
