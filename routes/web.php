<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Admin\BoatController;
use App\Http\Controllers\Web\Admin\FeedbackController;
use App\Http\Controllers\Web\Front\MainController;
use App\Http\Controllers\Web\Front\NewsController;
use App\Http\Controllers\Web\Front\EventController;
use App\Http\Controllers\Web\Front\HotelController;
use App\Http\Controllers\Web\Admin\ProfileController;
use App\Http\Controllers\Web\Admin\SettingController;
use App\Http\Controllers\Web\Front\TourismController;
use App\Http\Controllers\Web\Admin\MasterDataController;
use App\Http\Controllers\Web\Front\RestaurantController;
use App\Http\Controllers\Web\Admin\NewsController as AdminNewsController;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel');
Route::get('/hotel/{slug}', [HotelController::class, 'show'])->name('hotel.show');
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant');
Route::get('/restaurant/{slug}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::get('/wisata', [TourismController::class, 'index'])->name('wisata');
Route::get('/wisata/{slug}', [TourismController::class, 'show'])->name('wisata.show');
Route::get('/berita', [NewsController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');
Route::get('/festival', [EventController::class, 'index'])->name('festival');
Route::get('/faestival/{slug}', [EventController::class, 'show'])->name('festival.show');

Route::prefix('/auth')->middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/forget', [AuthController::class, 'forget'])->name('forget');
    Route::post('/forget', [AuthController::class, 'forgetSubmit'])->name('forget.submit');
    Route::get('/forget/{token}/reset', [AuthController::class, 'reset'])->name('reset');
    Route::post('/forget/{token}/reset', [AuthController::class, 'resetSubmit'])->name('reset.submit');
});
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', function () {
    return view('admin.dashboard', [
        'title' => 'Data Master',
        'subTitle' => 'Fasilitas',
        'page_id' => 1
        ]);
})->name('dashboard'); 

Route::prefix('/menu')->middleware(['auth'])->group(function () {
    Route::prefix('/data-master')->group(function () {
        Route::prefix('/fasilitas')->group(function () {
            Route::get('/', [MasterDataController::class, 'facility'])->name('admin.data-master.fasilitas');
            Route::post('/', [MasterDataController::class, 'facilityStore'])->name('admin.data-master.fasilitas.store');
            Route::post('/{id}/update', [MasterDataController::class, 'facilityUpdate'])->name('admin.data-master.fasilitas.update');
            Route::get('/{id}/destroy', [MasterDataController::class, 'facilityDestroy'])->name('admin.data-master.fasilitas.destroy');
        });
        Route::prefix('/kategori-wisata')->group(function () {
            Route::get('/', [MasterDataController::class, 'tourismCategory'])->name('admin.data-master.kategori-wisata');
            Route::post('/', [MasterDataController::class, 'tourismCategoryStore'])->name('admin.data-master.kategori-wisata.store');
            Route::post('/{id}/update', [MasterDataController::class, 'tourismCategoryUpdate'])->name('admin.data-master.kategori-wisata.update');
            Route::get('/{id}/destroy', [MasterDataController::class, 'tourismCategoryDestroy'])->name('admin.data-master.kategori-wisata.destroy');
        });
        Route::prefix('/kategori-hotel')->group(function () {
            Route::get('/', [MasterDataController::class, 'hotelCategory'])->name('admin.data-master.kategori-hotel');
            Route::post('/', [MasterDataController::class, 'hotelCategoryStore'])->name('admin.data-master.kategori-hotel.store');
            Route::post('/{id}/update', [MasterDataController::class, 'hotelCategoryUpdate'])->name('admin.data-master.kategori-hotel.update');
            Route::get('/{id}/destroy', [MasterDataController::class, 'hotelCategoryDestroy'])->name('admin.data-master.kategori-hotel.destroy');
        });
    });
    Route::prefix('/kapal')->group(function () {
        Route::get('/', [BoatController::class, 'boat'])->name('admin.kapal');
        Route::post('/', [BoatController::class, 'boatStore'])->name('admin.kapal.store');
        Route::post('/{id}/update', [BoatController::class, 'boatUpdate'])->name('admin.kapal.update');
        Route::get('/{id}/destroy', [BoatController::class, 'boatDestroy'])->name('admin.kapal.destroy');
    });
    Route::prefix('/berita')->group(function () {
        Route::get('/', [AdminNewsController::class, 'news'])->name('admin.berita.berita');
        Route::post('/', [BoatController::class, 'boatStore'])->name('admin.kapal.store');
        Route::post('/{id}/update', [BoatController::class, 'boatUpdate'])->name('admin.kapal.update');
        Route::get('/{id}/destroy', [BoatController::class, 'boatDestroy'])->name('admin.kapal.destroy');
    });
    Route::prefix('/pengaturan')->group(function () {
        Route::get('/', [SettingController::class, 'setting'])->name('admin.pengaturan');
        Route::post('/', [SettingController::class, 'settingUpdate'])->name('admin.pengaturan.update');
    });
    Route::prefix('/kuisioner')->group(function () {
        Route::get('/', [FeedbackController::class, 'feedback'])->name('admin.kuisioner');
        Route::get('/{id}/destroy', [FeedbackController::class, 'feedbackDestroy'])->name('admin.kuisioner.destroy');
    });
});

Route::prefix('/akun')->middleware(['auth'])->group(function () {
    Route::prefix('/profil')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('admin.profil');
        Route::post('/', [ProfileController::class, 'profileUpdate'])->name('admin.profil.update');
    });
});

