<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/health', function (){
   return response()->json([
        'success' => true,
        'environment' => config('app.env')
   ]);
});

// /api/books/

Route::prefix('/books')->group(function (){

    Route::get('/', [BookController::class, 'index']);
    Route::middleware('auth.api.token')->post('/create', [BookController::class, 'store']);

});
