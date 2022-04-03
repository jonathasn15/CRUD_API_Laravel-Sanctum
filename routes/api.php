<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/ping', function(){ return ['pong' => true]; });

//Rotas do sistema:
//login
Route::post('/auth',[AuthController::class, 'login']);

//Rota para user nao autenticado
Route::get('/unauthenticate', function(){
    return ['error' => 'Usuário não logado'];
})->name('login');

//logout
Route::middleware('auth:sanctum')->get('/auth/logout',[AuthController::class, 'logout']);

//create
Route::middleware('auth:sanctum')->post('/todo',[ApiController::class, 'createTodo']);
Route::post('/user',[AuthController::class, 'createUser']);

//read
Route::get('/todos',[ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}',[ApiController::class, 'readTodo']);

//update
Route::middleware('auth:sanctum')->put('/todo/{id}',[ApiController::class, 'updateTodo']);

//delete
Route::middleware('auth:sanctum')->delete('/todo/{id}',[ApiController::class, 'deleteTodo']);