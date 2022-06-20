<?php

use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\QuestionController;

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
    return redirect('login');
});

Route::get('/dashboard', function () {
        $user = User::get()->count();
        $question = Question::get()->count();
        return view('dashboard',compact('user','question'));
})->middleware('admin');


Route::group(["middleware" => ["admin"]],['prefix' => 'general'], function(){
    Route::get('blank-page', function () { return view('pages.admin.blank-page'); });
    Route::resource('questions',QuestionController::class);
    Route::resource('users',UserController::class);
    Route::resource('results',ResultController::class);
    Route::get('export_excel', [ResultController::class, 'store'])->name('export_excel');
    Route::get('admin/home', [HomeController::class, 'index'])->name('admin.route');

});

Auth::routes();
Route::get('/home', [HomeController::class, 'user'])->name('home');
Route::get('/start_quiz', [HomeController::class, 'quiz_start']);
Route::post('/submit_quiz', [HomeController::class, 'submit_answer'])->name('submit');
