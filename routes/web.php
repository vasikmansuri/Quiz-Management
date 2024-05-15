<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserQuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login.view');
Route::get('/register', function () {
    return view('register');
})->name('register.view');

Route::post('/login-action', [AuthController::class, 'loginAction'])->name('login.action');
Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register.action');
Route::group(['prefix'=>"user",'middleware' => 'auth.user'], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboardView'])->name('dashboard.view');
    Route::get('/question/answer', [UserQuestionController::class, 'questionList'])->name('users.question');
    Route::post('/start/test', [UserQuestionController::class, 'startTest'])->name('users.start.test');
    Route::post('/submit/answer', [UserQuestionController::class, 'submitAnswer'])->name('users.submit.answer');

});
Route::group(['prefix'=>"admin",'middleware' => 'auth.admin'], function () {

    Route::resource('questions', QuestionController::class);

    Route::get('dashboard', [AuthController::class, 'adminDashboardView'])->name('admin.dashboard');
    Route::get('users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::get('logout', [AuthController::class, 'Logout'])->name('users.logout');
    Route::post('add-user', [UserManagementController::class, 'addUser'])->name('admin.add.users');
    Route::post('update-user', [UserManagementController::class, 'updateUser'])->name('admin.update.users');
    Route::get('edit-user/{userId}', [UserManagementController::class, 'editUser'])->name('admin.edit.user');
    Route::get('delete-user/{userId}', [UserManagementController::class, 'deleteUser'])->name('admin.destroy.user');
});
