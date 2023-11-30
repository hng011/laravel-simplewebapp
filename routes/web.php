<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\AuthController;

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
Route::get('/auth/login', [AuthController::class,'login'])->name('login');
Route::post('/auth/startLogin', [AuthController::class, 'startLogin'])->name('startLogin');

Route::post('/searchNews', [GroupMemberController::class,'searchNews'])->name('searchNews');

Route::get('/', [GroupMemberController::class,'index'])->name('/');

Route::group(['prefix'=> 'admin','middleware' => ['auth'], 'as' => 'admin.'], function () {
    
    Route::get('/auth/logout', [AuthController::class,'logout'])->name('logout');
    
    Route::get('/dashboard', [GroupMemberController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/dashboard/addMember', [GroupMemberController::class, 'addMember'])->name('addMember');
    Route::post('/dashboard/storeMember', [GroupMemberController::class, 'storeMember'])->name('storeMember');
    
    Route::delete('/dashboard/{data}/deleteMember', [GroupMemberController::class, 'deleteMember'])->name('deleteMember');
    
    Route::get('/dashboard/{data}/editMember', [GroupMemberController::class,'editMember'])->name('editMember');
    Route::put('/dashboard/{data}/updateMember', [GroupMemberController::class,'updateMember'])->name('updateMember');

    Route::post('/dashboard/setNews', [GroupMemberController::class,'setNews'])->name('setNews');
});