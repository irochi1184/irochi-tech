<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/articles', function () {
    return response()->json([
        ['id' => 1, 'title' => 'First Article', 'content' => 'This is the content of the first article'],
        ['id' => 2, 'title' => 'Second Article', 'content' => 'This is the content of the second article']
    ]);
});
