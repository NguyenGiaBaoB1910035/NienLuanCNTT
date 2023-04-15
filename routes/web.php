<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BoardingRoomController;

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

//Route::get('/', function () {
//    return view('frontend.pages.home');
//});
Route::get('/',[\App\Http\Controllers\PageController::class, 'index'])->name('page.index');
Route::get('/{slug_room}',[\App\Http\Controllers\PageController::class, 'show_detail_room'])->name('page.show_detail_room');
Route::get('/dang-ky-thue-tro/{slug}',[\App\Http\Controllers\PageController::class, 'register_form'])->name('page.register_room.get');
Route::post('/dang-ky-thue-tro/{slug}',[\App\Http\Controllers\PageController::class, 'register_room'])->name('page.register_room.post');


Route::group(['prefix' => 'admin'], function () {
    // Login and Register
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'loginSubmit'])->name('admin.login.submit');
    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/register', [AdminController::class, 'registerSubmit'])->name('admin.register.submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Boarding House Manager
    Route::get('/boarding-house',[BoardingHouseController::class,'index'])->name('admin.boarding-house');
    Route::post('/boarding-house/add',[BoardingHouseController::class,'store'])->name('admin.boarding-house.post');

    // Boarding Room Manager
    Route::get('/boarding-room',[BoardingRoomController::class,'index'])->name('admin.boarding-room');
    Route::post('/boarding-room/add',[BoardingRoomController::class,'store'])->name('admin.boarding-room.post');
});

// Change languages
Route::get('/languages/{language}', function ($language) {
    if (!in_array($language, ['en', 'vi'])) {
        abort(404);
    }

    Session::put('website_language', $language);

    return redirect()->back();
})->name('settings.change-language');




