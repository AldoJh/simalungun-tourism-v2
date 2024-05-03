<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Admin\BoatController;
use App\Http\Controllers\Web\Admin\EventController as AdminEventController;
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
use App\Http\Controllers\Web\Admin\UserController;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel');
Route::get('/hotel/{slug}', [HotelController::class, 'show'])->name('hotel.show');
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant');
Route::get('/restaurant/{slug}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::get('/wisata', [TourismController::class, 'index'])->name('wisata');
Route::get('/wisata/{slug}', [TourismController::class, 'show'])->name('wisata.show');
Route::get('/berita', [NewsController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');
Route::post('/berita/{id}/comment', [NewsController::class, 'store'])->name('berita.comment');  
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
        Route::get('/add', [AdminNewsController::class, 'newsAdd'])->name('admin.berita.berita.add');
        Route::post('/add', [AdminNewsController::class, 'newsStore'])->name('admin.berita.berita.store');
        Route::get('/{id}/edit', [AdminNewsController::class, 'newsEdit'])->name('admin.berita.berita.edit');
        Route::post('/{id}/edit', [AdminNewsController::class, 'newsUpdate'])->name('admin.berita.berita.update');
        Route::get('/{id}/destroy', [AdminNewsController::class, 'newsDestroy'])->name('admin.berita.berita.destroy');
        Route::get('/{id}/komentar', [AdminNewsController::class, 'newsComment'])->name('admin.berita.berita.komentar');
        Route::get('/{id}/komentar/{idComment}/destroy', [AdminNewsController::class, 'newsCommentDestroy'])->name('admin.berita.berita.komentar.destroy');
        Route::get('/{id}/galeri', [AdminNewsController::class, 'newsGallery'])->name('admin.berita.berita.galeri');
        Route::post('/{id}/galeri', [AdminNewsController::class, 'newsGalleryStore'])->name('admin.berita.berita.galeri.store');
        Route::get('/{id}/galeri/{idGallery}/destroy', [AdminNewsController::class, 'newsGalleryDestroy'])->name('admin.berita.berita.galeri.destroy');
        Route::get('/komentar', [AdminNewsController::class, 'comment'])->name('admin.berita.komentar');
        Route::get('/komentar/{id}/destroy', [AdminNewsController::class, 'commentDestroy'])->name('admin.berita.komentar.destroy');
    });
    Route::prefix('/festival')->group(function () {
        Route::get('/', [AdminEventController::class, 'event'])->name('admin.festival.festival');
        Route::get('/add', [AdminEventController::class, 'eventAdd'])->name('admin.festival.festival.add');
        Route::post('/add', [AdminEventController::class, 'eventStore'])->name('admin.festival.festival.store');
        Route::get('/{id}/edit', [AdminEventController::class, 'eventEdit'])->name('admin.festival.festival.edit');
        Route::post('/{id}/edit', [AdminEventController::class, 'eventUpdate'])->name('admin.festival.festival.update');
        Route::get('/{id}/destroy', [AdminEventController::class, 'eventDestroy'])->name('admin.festival.festival.destroy');
        Route::get('/{id}/pengunjung', [AdminEventController::class, 'eventPengunjung'])->name('admin.festival.festival.pengunjung');
        Route::get('/pengunjung', [AdminEventController::class, 'visitor'])->name('admin.festival.pengunjung');
    });
    
    Route::prefix('/pengaturan')->group(function () {
        Route::get('/', [SettingController::class, 'setting'])->name('admin.pengaturan');
        Route::post('/', [SettingController::class, 'settingUpdate'])->name('admin.pengaturan.update');
    });
    Route::prefix('/kuisioner')->group(function () {
        Route::get('/', [FeedbackController::class, 'feedback'])->name('admin.kuisioner');
        Route::get('/{id}/destroy', [FeedbackController::class, 'feedbackDestroy'])->name('admin.kuisioner.destroy');
    });
    Route::prefix('/pengguna')->group(function () {
        Route::get('/', [UserController::class, 'user'])->name('admin.pengguna');
        Route::post('/', [UserController::class, 'userStore'])->name('admin.pengguna.store');
        Route::post('/{id}/update', [UserController::class, 'userUpdate'])->name('admin.pengguna.update');
        Route::get('/{id}/destroy', [UserController::class, 'userDestroy'])->name('admin.pengguna.destroy');
    });
});

Route::prefix('/akun')->middleware(['auth'])->group(function () {
    Route::prefix('/profil')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('admin.profil');
        Route::post('/', [ProfileController::class, 'profileUpdate'])->name('admin.profil.update');
    });
});

