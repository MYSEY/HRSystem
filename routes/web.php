<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AddressController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect('/admin');
});

Route::group(['middleware' => ['web',config('backpack.base.middleware_key', 'admin')
], 'namespace'  => 'admin'], function () {
    Route::get('address', [AddressController::class,'index'])->name('address');
});