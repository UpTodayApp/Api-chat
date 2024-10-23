<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\chatController;
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

Route::post('/chat/enviar', [chatController::class, 'enviarMensaje']);
Route::get('/chat/obtener', [chatController::class, 'obtenerMensajes']);
Route::put('/chat/{id}/visto', [chatController::class, 'marcarComoVisto']);