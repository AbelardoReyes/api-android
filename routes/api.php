<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuarios;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/registrarse', [Usuarios::class, 'registrarse']);
Route::post('/login', [Usuarios::class, 'login']);
Route::get('/info', [Usuarios::class, 'info'])->middleware('auth:sanctum');
Route::post('/cuentaAdafruit', [Usuarios::class, 'cuentaAdafruit'])->middleware('auth:sanctum');

