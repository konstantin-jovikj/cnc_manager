<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('pages.home');
// });

Route::get('/programs', [Controller::class, 'programs'])->name('programs');
Route::get('/tools', [Controller::class, 'tools'])->name('tools');
Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('view/program/{program}',[Controller::class, 'view'])->name('view.program');

// Route::get('/edit/tool/{tool}',[ToolController::class, 'edit'])->name('edit.tool');
