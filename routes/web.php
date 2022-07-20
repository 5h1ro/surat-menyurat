<?php

use App\Http\Controllers\Admin\DashboardController as ADashboardController;
use App\Http\Controllers\Admin\DispositionController as ADispositionController;
use App\Http\Controllers\Admin\PerbaikanSuratController as APerbaikanSuratController;
use App\Http\Controllers\Admin\ProfileController as AProfileController;
use App\Http\Controllers\Admin\SettingController as ASettingController;
use App\Http\Controllers\Admin\SuratKeluarController as ASuratKeluarController;
use App\Http\Controllers\Admin\SuratMasukController as ASuratMasukController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Headmaster\DashboardController as HDashboardController;
use App\Http\Controllers\Headmaster\DispositionController as HDispositionController;
use App\Http\Controllers\Headmaster\PerbaikanSuratController as HPerbaikanSuratController;
use App\Http\Controllers\Headmaster\ProfileController as HProfileController;
use App\Http\Controllers\Headmaster\SuratKeluarController as HSuratKeluarController;
use App\Http\Controllers\Headmaster\SuratMasukController as HSuratMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Staff\DashboardController as STDashboardController;
use App\Http\Controllers\Staff\ProfileController as STProfileController;
use App\Http\Controllers\Staff\SuratKeluarController as STSuratKeluarController;
use App\Http\Controllers\Staff\SuratMasukController as STSuratMasukController;
use App\Http\Controllers\Student\DashboardController as SDashboardController;
use App\Http\Controllers\Student\ProfileController as SProfileController;
use App\Http\Controllers\Student\PerbaikanSuratController as SPerbaikanSuratController;
use App\Http\Controllers\Superadmin\DashboardController as SUDashboardController;
use App\Http\Controllers\Superadmin\DataUserController as SUDataUserController;
use App\Http\Controllers\Superadmin\ProfileController as SUProfileController;
use App\Http\Controllers\Superadmin\RoleController as SURoleController;
use App\Http\Controllers\Teacher\DashboardController as TDashboardController;
use App\Http\Controllers\Teacher\ProfileController as TProfileController;
use App\Http\Controllers\Teacher\SuratKeluarController as TSuratKeluarController;
use App\Http\Controllers\Teacher\SuratMasukController as TSuratMasukController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
})->name('start');
// Route::get('/forgot-password', function (){
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');


Route::get('/end', function () {
    Auth::guard('web')->logout();
    return redirect('/');
})->name('end');


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::middleware(['teacher'])->group(function () {

        Route::prefix('teacher')->group(function () {
            Route::get('/dashboard', [TDashboardController::class, 'index'])->name('teacher');

            Route::prefix('surat-masuk')->group(function () {
                Route::get('/index', [TSuratMasukController::class, 'index'])->name('teacher.suratmasuk.index');
                Route::get('/read/{id}', [TSuratMasukController::class, 'read'])->name('teacher.suratmasuk.read');
            });
            Route::prefix('surat-keluar')->group(function () {
                Route::get('/index', [TSuratKeluarController::class, 'index'])->name('teacher.suratkeluar.index');
                Route::get('/read/{id}', [TSuratKeluarController::class, 'read'])->name('teacher.suratkeluar.read');
                Route::get('/delete/{id}', [TSuratKeluarController::class, 'delete'])->name('teacher.suratkeluar.delete');
                Route::post('/create', [TSuratKeluarController::class, 'create'])->name('teacher.suratkeluar.create');
                Route::post('/upload/{id}', [TSuratKeluarController::class, 'upload'])->name('teacher.suratkeluar.upload');
            });
            Route::prefix('profil')->group(function () {
                Route::get('/index', [TProfileController::class, 'index'])->name('teacher.profil.index');
                Route::post('/edit/{id}', [TProfileController::class, 'edit'])->name('teacher.profil.edit');
            });
        });
    });
    Route::middleware(['staff'])->group(function () {

        Route::prefix('staff')->group(function () {
            Route::get('/dashboard', [STDashboardController::class, 'index'])->name('staff');

            Route::prefix('surat-masuk')->group(function () {
                Route::get('/index', [STSuratMasukController::class, 'index'])->name('staff.suratmasuk.index');
                Route::get('/read/{id}', [STSuratMasukController::class, 'read'])->name('staff.suratmasuk.read');
            });
            Route::prefix('surat-keluar')->group(function () {
                Route::get('/index', [STSuratKeluarController::class, 'index'])->name('staff.suratkeluar.index');
                Route::get('/read/{id}', [STSuratKeluarController::class, 'read'])->name('staff.suratkeluar.read');
                Route::get('/delete/{id}', [STSuratKeluarController::class, 'delete'])->name('staff.suratkeluar.delete');
                Route::post('/create', [STSuratKeluarController::class, 'create'])->name('staff.suratkeluar.create');
                Route::post('/upload/{id}', [STSuratKeluarController::class, 'upload'])->name('staff.suratkeluar.upload');
            });
            Route::prefix('profil')->group(function () {
                Route::get('/index', [STProfileController::class, 'index'])->name('staff.profil.index');
                Route::post('/edit/{id}', [STProfileController::class, 'edit'])->name('staff.profil.edit');
            });
        });
    });
    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [ADashboardController::class, 'index'])->name('admin');

            Route::prefix('surat-masuk')->group(function () {
                Route::get('/index', [ASuratMasukController::class, 'index'])->name('admin.suratmasuk.index');
                Route::get('/read/{id}', [ASuratMasukController::class, 'read'])->name('admin.suratmasuk.read');
                Route::post('/create', [ASuratMasukController::class, 'create'])->name('admin.suratmasuk.create');
                Route::get('/search={value}', [ASuratMasukController::class, 'search'])->name('admin.suratmasuk.search');
                Route::get('/delete/{id}', [ASuratMasukController::class, 'delete'])->name('admin.suratmasuk.delete');
            });

            Route::prefix('disposisi')->group(function () {
                Route::get('/index', [ADispositionController::class, 'index'])->name('admin.disposisi.index');
                Route::get('/read/{id}', [ADispositionController::class, 'read'])->name('admin.disposisi.read');
                Route::post('/upload/{id}', [ADispositionController::class, 'upload'])->name('admin.disposisi.upload');
            });
            Route::prefix('surat-keluar')->group(function () {
                Route::get('/index', [ASuratKeluarController::class, 'index'])->name('admin.suratkeluar.index');
                Route::get('/acc/{id}', [ASuratKeluarController::class, 'acc'])->name('admin.suratkeluar.acc');
                Route::get('/not_acc/{id}', [ASuratKeluarController::class, 'not_acc'])->name('admin.suratkeluar.not_acc');
                Route::post('/upload/{id}', [ASuratKeluarController::class, 'upload'])->name('admin.suratkeluar.upload');
            });
            Route::prefix('perbaikan-surat')->group(function () {
                Route::get('/index', [APerbaikanSuratController::class, 'index'])->name('admin.perbaikansurat.index');
                Route::get('/acc/{id}', [APerbaikanSuratController::class, 'acc'])->name('admin.perbaikansurat.acc');
                Route::get('/not_acc/{id}', [APerbaikanSuratController::class, 'not_acc'])->name('admin.perbaikansurat.not_acc');
                Route::post('/upload/{id}', [APerbaikanSuratController::class, 'upload'])->name('admin.perbaikansurat.upload');
            });
            Route::prefix('pengaturan')->group(function () {
                Route::get('/index', [ASettingController::class, 'index'])->name('admin.pengaturan.index');
                Route::post('/edit', [ASettingController::class, 'edit'])->name('admin.pengaturan.edit');
            });
            Route::prefix('profil')->group(function () {
                Route::get('/index', [AProfileController::class, 'index'])->name('admin.profil.index');
                Route::post('/edit/{id}', [AProfileController::class, 'edit'])->name('admin.profil.edit');
            });
        });
    });
    Route::middleware(['headmaster'])->group(function () {
        Route::prefix('headmaster')->group(function () {
            Route::get('/dashboard', [HDashboardController::class, 'index'])->name('headmaster');

            Route::prefix('surat-masuk')->group(function () {
                Route::get('/index', [HSuratMasukController::class, 'index'])->name('headmaster.suratmasuk.index');
                Route::get('/read/{id}', [HSuratMasukController::class, 'read'])->name('headmaster.suratmasuk.read');
            });

            Route::prefix('disposisi')->group(function () {
                Route::get('/index', [HDispositionController::class, 'index'])->name('headmaster.disposisi.index');
                Route::get('/read/{id}', [HDispositionController::class, 'read'])->name('headmaster.disposisi.read');
                Route::get('/acc/{id}', [HDispositionController::class, 'acc'])->name('headmaster.disposisi.acc');
                Route::get('/not_acc/{id}', [HDispositionController::class, 'not_acc'])->name('headmaster.disposisi.not_acc');
                Route::post('/edit/{id}', [HDispositionController::class, 'edit'])->name('headmaster.disposisi.edit');
            });

            Route::prefix('surat-keluar')->group(function () {
                Route::get('/index', [HSuratKeluarController::class, 'index'])->name('headmaster.suratkeluar.index');
                Route::get('/acc/{id}', [HSuratKeluarController::class, 'acc'])->name('headmaster.suratkeluar.acc');
                Route::get('/not_acc/{id}', [HSuratKeluarController::class, 'not_acc'])->name('headmaster.suratkeluar.not_acc');
            });

            Route::prefix('perbaikan-surat')->group(function () {
                Route::get('/index', [HPerbaikanSuratController::class, 'index'])->name('headmaster.perbaikansurat.index');
                Route::get('/acc/{id}', [HPerbaikanSuratController::class, 'acc'])->name('headmaster.perbaikansurat.acc');
                Route::get('/not_acc/{id}', [HPerbaikanSuratController::class, 'not_acc'])->name('headmaster.perbaikansurat.not_acc');
            });

            Route::prefix('profil')->group(function () {
                Route::get('/index', [HProfileController::class, 'index'])->name('headmaster.profil.index');
                Route::post('/edit/{id}', [HProfileController::class, 'edit'])->name('headmaster.profil.edit');
            });
        });
    });
    Route::middleware(['student'])->group(function () {
        Route::prefix('student')->group(function () {
            Route::get('/dashboard', [SDashboardController::class, 'index'])->name('student');

            Route::prefix('perbaikan-surat')->group(function () {
                Route::get('/index', [SPerbaikanSuratController::class, 'index'])->name('student.perbaikansurat.index');
                Route::get('/read/{id}', [SPerbaikanSuratController::class, 'read'])->name('student.perbaikansurat.read');
                Route::get('/delete/{id}', [SPerbaikanSuratController::class, 'delete'])->name('student.perbaikansurat.delete');
                Route::post('/create', [SPerbaikanSuratController::class, 'create'])->name('student.perbaikansurat.create');
            });

            Route::prefix('profil')->group(function () {
                Route::get('/index', [SProfileController::class, 'index'])->name('student.profil.index');
                Route::post('/edit/{id}', [SProfileController::class, 'edit'])->name('student.profil.edit');
            });
        });
    });
    Route::middleware(['superadmin'])->group(function () {
        Route::prefix('superadmin')->group(function () {
            Route::get('/dashboard', [SUDashboardController::class, 'index'])->name('superadmin');
        });
        Route::prefix('role')->group(function () {
            Route::get('/index', [SURoleController::class, 'index'])->name('superadmin.role.index');
            Route::post('/edit/{id}', [SURoleController::class, 'edit'])->name('superadmin.role.edit');
        });
        Route::prefix('profil')->group(function () {
            Route::get('/index', [SUProfileController::class, 'index'])->name('superadmin.profil.index');
            Route::post('/edit/{id}', [SUProfileController::class, 'edit'])->name('superadmin.profil.edit');
        });
        Route::prefix('datauser')->group(function () {
            Route::get('/index', [SUDataUserController::class, 'index'])->name('superadmin.datauser.index');
            Route::post('/create', [SUDataUserController::class, 'create'])->name('superadmin.user.create');
            Route::post('/store', [SUDataUserController::class, 'store'])->name('superadmin.user.store');
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
