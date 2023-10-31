<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\VideosController;

Route::post('/cadastrar-usuario', [UsuariosController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt'])->group(function () {
    Route::get('/listar', [UsuariosController::class, 'index']);
    Route::get('/buscar/{id}', [UsuariosController::class, 'show']);
    Route::put('/atualizar-usuario/{id}', [UsuariosController::class, 'update']);
    Route::delete('/deletar-usuario/{id}', [UsuariosController::class, 'destroy']);

    Route::post('/cadastrar-tag', [TagsController::class, 'store']);
    Route::get('/listar-tags', [TagsController::class, 'index']);
    Route::get('/buscar-tag/{id}', [TagsController::class, 'show']);
    Route::put('/atualizar-tag/{id}', [TagsController::class, 'update']);

    Route::post('/cadastrar-video', [VideosController::class, 'store']);
    Route::get('/listar-videos', [VideosController::class, 'index']);
    Route::put('/atualizar-video/{id}', [VideosController::class, 'update']);
    Route::delete('/deletar-video/{id}', [VideosController::class, 'destroy']);

});





