<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\JenisProgramController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFunction;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/kirim-pesan', [HomeController::class, 'pesan'])->name('kirimpesan');
Route::get('/view-image', [HomeController::class, 'view_image']);
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/visi-misi', [HomeController::class, 'visi_misi']);
Route::get('/tenaga-pendidik', [HomeController::class, 'tenaga_pendidik']);
Route::get('/tenaga-kependidikan', [HomeController::class, 'tenaga_kependidikan']);
Route::get('/sambutan-kepala-madrasah', [HomeController::class, 'sambutan'])->name('sambutan');
Route::get('/sejarah-madrasah', [HomeController::class, 'sejarah'])->name('sejarah');
Route::get('/sarana-prasarana', [HomeController::class, 'sarpras'])->name('sarpras');
Route::get('/program', [HomeController::class, 'program'])->name('program-view');

Route::get('/struktur-organisasi', [HomeController::class, 'struktur_organisasi'])->name('struktur-organisasi');
Route::get('/agenda', [AgendaController::class, 'list'])->name('agenda-list');
Route::get('/agenda/detail/{id}', [AgendaController::class, 'show'])->name('agenda-detail');
Route::get('/program-list/{id}', [HomeController::class, 'program_list'])->name('program');
//Route::get('/ppdb', [HomeController::class, 'ppdb']);
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::prefix('/berita')->group(function () {
    Route::get('/', [HomeController::class, 'berita']);
    Route::get('/detail/{slug}', [HomeController::class, 'berita_detail'])->name('berita-detail');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/autentikasi', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix(config('setting.url_panel'))->group(function () {
        Route::get('/dashboard', [PanelController::class, 'dashboard'])->name('dashboard');
        Route::middleware('admin')->group(function () {
            Route::prefix('/admin')->group(function () {
                Route::prefix('/guru-staff')->group(function () {
                    Route::get('/', [AdminController::class, 'guru_staff'])->name('guru-staff');
                    Route::get('/edit/{uid}', [AdminController::class, 'edit_gs'])->name('gs-edit');
                    Route::put('/edit/{uid}', [AdminFunction::class, 'edit_gs'])->name('gs-edit-progress');
                    Route::delete('/hapus/{uid}', [AdminFunction::class, 'hapus_gs'])->name('gs-hapus');
                    Route::post('/tambah', [AdminFunction::class, 'tambah_gs'])->name('gs-tambah');
                });
                Route::prefix('/gstb')->group(function () {
                    Route::get('/backup', [AdminFunction::class, 'backup_gs'])->name('backup-gs');
                    Route::post('/restore', [AdminFunction::class, 'restore_gs'])->name('restore-gs');
                });
                Route::get('/agenda/checkSlug', [AgendaController::class, 'checkSlug']);
                Route::get('/agenda/backup', [AgendaController::class, 'backup'])->name('backup-agenda');
                Route::post('/agenda/restore', [AgendaController::class, 'restore'])->name('restore-agenda');
                Route::resource('/agenda', AgendaController::class, [
                    'names' => [
                        'index' => 'agenda',
                        'create' => 'agenda-tambah',
                        'store' => 'agenda-tambah-progress',
                        'edit' => 'agenda-edit',
                        'update' => 'agenda-edit-progress',
                        'destroy' => 'agenda-hapus',
                    ]
                ])->except('show');
                Route::resource('/jenis-program', JenisProgramController::class, [
                    'names' => [
                        'index' => 'jp',
                        'store' => 'jp-tambah',
                        'update' => 'jp-edit',
                        'destroy' => 'jp-hapus',
                    ]
                ])->except('show', 'create', 'edit');
                Route::resource('/program', ProgramController::class, [
                    'names' => [
                        'index' => 'program',
                        'create' => 'program-tambah',
                        'store' => 'program-tambah-progress',
                        'edit' => 'program-edit',
                        'update' => 'program-edit-progress',
                        'destroy' => 'program-hapus',
                    ]
                ])->except('show');
            });
        });

        Route::middleware('media')->group(function () {
            Route::get('/post/checkSlug', [PostController::class, 'checkSlug']);
            Route::resource('/post', PostController::class, [
                'names' => [
                    'index' => 'post',
                    'create' => 'post-create',
                    'store' => 'post-store',
                    'edit' => 'post-edit',
                    'update' => 'post-update',
                    'destroy' => 'post-destroy',
                ]
            ])->except('show');
            Route::resource('/kategori', CategoriesController::class)->except('show', 'create', 'edit');
            Route::prefix('/posttb')->group(function () {
                Route::get('/backup', [PostTableController::class, 'backup'])->name('backup-post');
                Route::post('/restore', [PostTableController::class, 'restore'])->name('restore-post');
            });
        });
        Route::resource('/profile', ProfileController::class)->except('create', 'store', 'destroy', 'show','edit');
    });
});


Route::middleware('api')->group(function () {
    Route::prefix('api')->group(function () {
        Route::post('/blog', [APIController::class, 'blog'])->name('api-blog');
        Route::post('/gs', [APIController::class, 'gs'])->name('api-gs');
        Route::get('/blog', [APIController::class, 'blog_front'])->name('api-blog-public');
        Route::get('/agenda', [APIController::class, 'agenda_front'])->name('api-agenda-public');
    });
});

Route::prefix('public-api')->group(function () {
    Route::get('/latest-blog', [APIController::class, 'get_post']);
//    Route::get('/gs', [APIController::class, 'gs'])->name('api-public-gs');
//    Route::get('/ai', [APIController::class, 'openai'])->name('ai');
//    Route::get('/test', function () {
//        return view('test');
//    });
    Route::get('/agenda', [APIController::class, 'agenda_front'])->name('api-agenda-public');
});

Route::get('/{any}', function () {
//    return redirect()->route('home');
    return abort(404);
})->where('any', '.*');


