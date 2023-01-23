<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;


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

Route::prefix('client')->group(function () { 
    Route::post('/', function (Request $request) {
        $client = DB::table('oauth_clients')->where('password_client', true)->first();

        return response()->json(['client' => $client], 200);
    });
});

Route::middleware([ 'cors', 'auth:api', 'client_credentials'])->group(function () {
    Route::post('/logout', function (Request $request) {
        auth()->user()->tokens->each( function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully');
    });

    Route::prefix('companies')->group(function () { 
        Route::post('/', [CompanyController::class, 'index']);
        Route::post('/create', [CompanyController::class, 'create']); 
        Route::post('/update', [CompanyController::class, 'update']); 
        Route::post('/delete', [CompanyController::class, 'delete']); 
    });

    Route::prefix('departments')->group(function () { 
        Route::post('/', [DepartmentController::class, 'index']);
        Route::post('/create', [DepartmentController::class, 'create']); 
        Route::post('/update', [DepartmentController::class, 'update']); 
        Route::post('/delete', [DepartmentController::class, 'delete']);
        Route::post('/send-sms', [DepartmentController::class, 'sendMessage']); 
    });

    Route::prefix('employees')->group(function () { 
        Route::post('/', [EmployeeController::class, 'index']);
        Route::post('/create', [EmployeeController::class, 'create']); 
        Route::post('/update', [EmployeeController::class, 'update']); 
        Route::post('/delete', [EmployeeController::class, 'delete']);
        Route::post('/send-sms', [DepartmentController::class, 'sendMessage']); 
    });

    Route::prefix('users')->group(function () { 
        Route::post('/', [UserController::class, 'index']);
        Route::post('/create', [UserController::class, 'create']); 
        Route::post('/update', [UserController::class, 'update']); 
        Route::post('/delete', [UserController::class, 'delete']);
    });

    Route::prefix('logs')->group(function () { 
        Route::post('/', function (Request $request) {
            $logs = DB::table('logs')->orderBy('created_at', 'desc')->get();

            return response()->json(['data' => $logs], 200);
        });
    });
    
});
 