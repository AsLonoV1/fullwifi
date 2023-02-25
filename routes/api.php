<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\WorkmanDocumentController;

Route::post('login', [AuthController::class, 'login']);
Route::post('refresh/token', [AuthController::class, 'refreshToken']);

Route::group(['middleware' => ["auth:api"]], function () {
    Route::group(['middleware' => ["isAdmin:api"]], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('list', [UserController::class, 'list']);
            Route::get('show', [UserController::class, 'show']);
            Route::post('create', [UserController::class, 'create']);
            Route::post('update', [UserController::class, 'update']);
            Route::get('delete', [UserController::class, 'delete']);
        }); 
        Route::group(['prefix' => 'warehouse'], function () {
            Route::prefix('type')->group(function () {
                Route::get('list', [TypeController::class, 'list']);
                Route::post('create', [TypeController::class, 'create']);
                Route::post('update', [TypeController::class, 'update']);
                Route::get('delete', [TypeController::class, 'delete']);
            });
            Route::get('list', [WareHouseController::class, 'list']);
            Route::post('create', [WareHouseController::class, 'create']);
            Route::post('update', [WareHouseController::class, 'update']);
            Route::get('delete', [WareHouseController::class, 'delete']);
        });
    });
        Route::group(['prefix' => 'document'], function () {
            Route::get('list',[DocumentController::class,'list'])->middleware('isList:api');
            Route::get('abort/list',[WorkmanDocumentController::class,'abortList'])->middleware('isWorkman:api');
            Route::post('create',[WorkmanDocumentController::class,'create'])->middleware('isWorkman:api');
            Route::post('update',[WorkmanDocumentController::class,'update'])->middleware('isWorkman:api');
            Route::get('delete',[WorkmanDocumentController::class,'delete'])->middleware('isWorkman:api');
            Route::get('send',[DocumentController::class,'send'])->middleware('isSend:api');
            Route::get('unsend',[DocumentController::class,'unsend'])->middleware('isUnsend:api');  
        });
    Route::get('logOut', [AuthController::class, 'logOut']);
});
