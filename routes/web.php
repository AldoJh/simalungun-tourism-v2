<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Admin\BoatController;
use App\Http\Controllers\web\admin\DestinationController;
use App\Http\Controllers\Web\Admin\EventController as AdminEventController;
use App\Http\Controllers\Web\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Web\Admin\HotelController as AdminHotelController;
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
use App\Http\Controllers\Web\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\web\admin\ReviewController;
use App\Http\Controllers\Web\Admin\TourismController as AdminTourismController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Front\FeedbackController;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel');
Route::get('/hotel/{slug}', [HotelController::class, 'show'])->name('hotel.show');
Route::get('/hotel/{slug}', [HotelController::class, 'show'])->name('hotel.show');
Route::post('/hotel/{id}/review', [HotelController::class, 'store'])->name('hotel.review');
Route::get('/restoran', [RestaurantController::class, 'index'])->name('restoran');
Route::get('/restoran/{slug}', [RestaurantController::class, 'show'])->name('restoran.show');
Route::post('/restoran/{id}/review', [RestaurantController::class, 'store'])->name('restoran.review');
Route::get('/wisata', [TourismController::class, 'index'])->name('wisata');
Route::get('/wisata/{slug}', [TourismController::class, 'show'])->name('wisata.show');
Route::post('/wisata/{id}/review', [TourismController::class, 'store'])->name('wisata.review');
Route::get('/berita', [NewsController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');
Route::post('/berita/{id}/comment', [NewsController::class, 'store'])->name('berita.comment');  
Route::get('/festival', [EventController::class, 'index'])->name('festival');
Route::get('/festival/{slug}', [EventController::class, 'show'])->name('festival.show');
Route::get('/kuisioner', [FeedbackController::class, 'index'])->name('kuisioner');
Route::post('/kuisioner', [FeedbackController::class, 'store'])->name('kuisioner.store');

Route::prefix('/auth')->middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
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
        'title' => 'Dashboard',
        'subTitle' => null,
        'page_id' => 1
        ]);
})->name('dashboard'); 

Route::prefix('/menu')->middleware(['auth'])->group(function () {
    Route::prefix('/data-master')->middleware(['role:superadmin'])->group(function () {
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
    Route::prefix('/kapal')->middleware(['role:superadmin'])->group(function () {
        Route::get('/', [BoatController::class, 'boat'])->name('admin.kapal');
        Route::post('/', [BoatController::class, 'boatStore'])->name('admin.kapal.store');
        Route::post('/{id}/update', [BoatController::class, 'boatUpdate'])->name('admin.kapal.update');
        Route::get('/{id}/destroy', [BoatController::class, 'boatDestroy'])->name('admin.kapal.destroy');
    });
    Route::prefix('/berita')->middleware(['role:superadmin'])->group(function () {
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
        Route::middleware(['role:superadmin'])->group(function(){
            Route::get('/', [AdminEventController::class, 'event'])->name('admin.festival.festival');
            Route::get('/add', [AdminEventController::class, 'eventAdd'])->name('admin.festival.festival.add');
            Route::post('/add', [AdminEventController::class, 'eventStore'])->name('admin.festival.festival.store');
            Route::get('/{id}/edit', [AdminEventController::class, 'eventEdit'])->name('admin.festival.festival.edit');
            Route::post('/{id}/edit', [AdminEventController::class, 'eventUpdate'])->name('admin.festival.festival.update');
            Route::get('/{id}/destroy', [AdminEventController::class, 'eventDestroy'])->name('admin.festival.festival.destroy');
            Route::get('/pengunjung', [AdminEventController::class, 'visitor'])->name('admin.festival.pengunjung');
    
        });
            Route::get('/{id}/pengunjung', [AdminEventController::class, 'eventVisitor'])->name('admin.festival.festival.pengunjung');
            Route::post('/{id}/pengunjung', [AdminEventController::class, 'eventVisitorStore'])->name('admin.festival.festival.pengunjung.store');
            Route::post('/{id}/pengunjung/{idVisitor}/update', [AdminEventController::class, 'eventVisitorUpdate'])->name('admin.festival.festival.pengunjung.update');
            Route::get('/{id}/pengunjung/{idVisitor}/destroy', [AdminEventController::class, 'eventVisitorDestroy'])->name('admin.festival.festival.pengunjung.destroy');
            Route::get('/{id}/galeri', [AdminEventController::class, 'eventGallery'])->name('admin.festival.festival.galeri');
            Route::post('/{id}/galeri', [AdminEventController::class, 'eventGalleryStore'])->name('admin.festival.festival.galeri.store');
            Route::get('/{id}/galeri/{idGallery}/destroy', [AdminEventController::class, 'eventGalleryDestroy'])->name('admin.festival.festival.galeri.destroy');
            Route::get('/{id}/atribut', [AdminEventController::class, 'eventAttribute'])->name('admin.festival.festival.atribut');
            Route::post('/{id}/atribut', [AdminEventController::class, 'eventAttributeStore'])->name('admin.festival.festival.atribut.store');
            Route::post('/{id}/atribut/{idAttribute}/update', [AdminEventController::class, 'eventAttributeUpdate'])->name('admin.festival.festival.atribut.update');
            Route::get('/{id}/admin', [AdminEventController::class, 'eventAdmin'])->name('admin.festival.festival.admin');
    });

    Route::prefix('/restoran')->group(function () {
        Route::middleware(['role:superadmin'])->group(function(){
            Route::get('/', [AdminRestaurantController::class, 'restaurant'])->name('admin.restoran.restoran');
            Route::get('/add', [AdminRestaurantController::class, 'restaurantAdd'])->name('admin.restoran.restoran.add');
            Route::post('/add', [AdminRestaurantController::class, 'restaurantStore'])->name('admin.restoran.restoran.store');
            Route::get('/{id}/edit', [AdminRestaurantController::class, 'restaurantEdit'])->name('admin.restoran.restoran.edit');
            Route::post('/{id}/edit', [AdminRestaurantController::class, 'restaurantUpdate'])->name('admin.restoran.restoran.update');
            Route::get('/{id}/destroy', [AdminRestaurantController::class, 'restaurantDestroy'])->name('admin.restoran.restoran.destroy');
            Route::get('/{id}/pengunjung', [AdminRestaurantController::class, 'restaurantVisitor'])->name('admin.restoran.restoran.pengunjung');
            Route::get('/review', [AdminRestaurantController::class, 'review'])->name('admin.restoran.review');
            Route::get('/review/{id}/destroy', [AdminRestaurantController::class, 'reviewDestroy'])->name('admin.restoran.review.destroy');
            Route::get('/pengunjung', [AdminRestaurantController::class, 'visitor'])->name('admin.restoran.pengunjung');
        });

    });
    
    Route::prefix('/hotel')->group(function () {
        Route::middleware(['role:superadmin'])->group(function(){
            Route::get('/', [AdminHotelController::class, 'hotel'])->name('admin.hotel.hotel');
            Route::get('/add', [AdminHotelController::class, 'hotelAdd'])->name('admin.hotel.hotel.add');
            Route::post('/add', [AdminHotelController::class, 'hotelStore'])->name('admin.hotel.hotel.store');
            Route::get('/{id}/edit', [AdminHotelController::class, 'hotelEdit'])->name('admin.hotel.hotel.edit');
            Route::post('/{id}/edit', [AdminHotelController::class, 'hotelUpdate'])->name('admin.hotel.hotel.update');
            Route::get('/{id}/destroy', [AdminHotelController::class, 'hotelDestroy'])->name('admin.hotel.hotel.destroy');
            Route::get('/{id}/pengunjung', [AdminHotelController::class, 'hotelVisitor'])->name('admin.hotel.hotel.pengunjung');
            Route::get('/review', [AdminHotelController::class, 'review'])->name('admin.hotel.review');
            Route::get('/review/{id}/destroy', [AdminHotelController::class, 'reviewDestroy'])->name('admin.hotel.review.destroy');
            Route::get('/pengunjung', [AdminHotelController::class, 'visitor'])->name('admin.hotel.pengunjung');
        });
    });
    
    Route::prefix('/wisata')->group(function () {
        Route::middleware(['role:superadmin'])->group(function(){
            Route::get('/', [AdminTourismController::class, 'tourism'])->name('admin.wisata.wisata');
            Route::get('/add', [AdminTourismController::class, 'tourismAdd'])->name('admin.wisata.wisata.add');
            Route::post('/add', [AdminTourismController::class, 'tourismStore'])->name('admin.wisata.wisata.store');
            Route::get('/{id}/edit', [AdminTourismController::class, 'tourismEdit'])->name('admin.wisata.wisata.edit');
            Route::post('/{id}/edit', [AdminTourismController::class, 'tourismUpdate'])->name('admin.wisata.wisata.update');
            Route::get('/{id}/destroy', [AdminTourismController::class, 'tourismDestroy'])->name('admin.wisata.wisata.destroy');
            Route::get('/{id}/pengunjung', [AdminTourismController::class, 'tourismVisitor'])->name('admin.wisata.wisata.pengunjung');
            Route::get('/review', [AdminTourismController::class, 'review'])->name('admin.wisata.review');
            Route::get('/review/{id}/destroy', [AdminTourismController::class, 'reviewDestroy'])->name('admin.wisata.review.destroy');
            Route::get('/pengunjung', [AdminTourismController::class, 'visitor'])->name('admin.wisata.pengunjung');
        });
    });

    Route::prefix('/pengaturan')->middleware(['role:superadmin'])->group(function () {
        Route::get('/', [SettingController::class, 'setting'])->name('admin.pengaturan');
        Route::post('/', [SettingController::class, 'settingUpdate'])->name('admin.pengaturan.update');
    });
    Route::prefix('/kuisioner')->middleware(['role:superadmin'])->group(function () {
        Route::get('/', [AdminFeedbackController::class, 'feedback'])->name('admin.kuisioner');
        Route::get('/{id}/destroy', [AdminFeedbackController::class, 'feedbackDestroy'])->name('admin.kuisioner.destroy');
    });
    Route::prefix('/pengguna')->middleware(['role:superadmin'])->group(function () {
        Route::get('/', [UserController::class, 'user'])->name('admin.pengguna');
        Route::post('/', [UserController::class, 'userStore'])->name('admin.pengguna.store');
        Route::post('/{id}/update', [UserController::class, 'userUpdate'])->name('admin.pengguna.update');
        Route::get('/{id}/destroy', [UserController::class, 'userDestroy'])->name('admin.pengguna.destroy');
        Route::get('/{id}/akses', [UserController::class, 'permission'])->name('admin.pengguna.akses');
        Route::post('/{id}/akses', [UserController::class, 'permissionUpdate'])->name('admin.pengguna.akses.update');
    });
    Route::prefix('/admin-destinasi')->middleware(['role:admin'])->group(function () {
        Route::get('/wisata', [DestinationController::class, 'tourism'])->name('admin.admin-destinasi.wisata');
        Route::get('/hotel', [DestinationController::class, 'hotel'])->name('admin.admin-destinasi.hotel');
        Route::get('/restoran', [DestinationController::class, 'restaurant'])->name('admin.admin-destinasi.restoran');
        Route::get('/festival', [DestinationController::class, 'event'])->name('admin.admin-destinasi.festival');
    });
});

Route::prefix('/akun')->middleware(['auth'])->group(function () {
    Route::prefix('/my-review')->group(function () {
        Route::get('/wisata', [ReviewController::class, 'tourism'])->name('my-review.wisata');
        Route::get('/wisata/{id}/destroy', [ReviewController::class, 'tourismDestroy'])->name('my-review.wisata.destroy');
        Route::get('/hotel', [ReviewController::class, 'hotel'])->name('my-review.hotel');
        Route::get('/hotel/{id}/destroy', [ReviewController::class, 'hotelDestroy'])->name('my-review.hotel.destroy');
        Route::get('/restoran', [ReviewController::class, 'restaurant'])->name('my-review.restoran');
        Route::get('/restoran/{id}/destroy', [ReviewController::class, 'restaurantDestroy'])->name('my-review.restoran.destroy');
    });
    Route::prefix('/profil')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('admin.profil');
        Route::post('/', [ProfileController::class, 'profileUpdate'])->name('admin.profil.update');
    });
});

