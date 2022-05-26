<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
});

//Category Routes
Route::get('/category/all', [CategoryController::class, 'AllCategory'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCategory']);
Route::post('category/update/{id}', [CategoryController::class, 'UpdateCategory']);
Route::get('category/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('category/delete/{id}', [CategoryController::class, 'permanentDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'restoreCategory']);

//Brand Routes
Route::get('/brand/all', [BrandController::class, 'AllBrands'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        $users_data = User::all();

        return view('dashboard', ['users_data'=>$users_data]);
    })->name('dashboard');
});