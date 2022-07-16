<?php

use App\Http\Controllers\Admin\DispositionController as ADispositionController;
use App\Http\Controllers\Admin\PerbaikanSuratController as APerbaikanSuratController;
use App\Http\Controllers\Admin\SuratKeluarController as ASuratKeluarController;
use App\Http\Controllers\Teacher\SuratKeluarController as TSuratKeluarController;
use App\Http\Controllers\Teacher\SuratMasukController as TSuratMasukController;
use App\Http\Controllers\Admin\SuratMasukController as ASuratMasukController;
use App\Http\Controllers\Headmaster\DispositionController as HDispositionController;
use App\Http\Controllers\Headmaster\PerbaikanSuratController as HPerbaikanSuratController;
use App\Http\Controllers\Headmaster\SuratKeluarController as HSuratKeluarController;
use App\Http\Controllers\Headmaster\SuratMasukController as HSuratMasukController;
use App\Http\Controllers\Staff\SuratKeluarController as STSuratKeluarController;
use App\Http\Controllers\Staff\SuratMasukController as STSuratMasukController;
use App\Http\Controllers\Student\PerbaikanSuratController as SPerbaikanSuratController;
use App\Http\Controllers\Superadmin\RoleController as SURoleController;
use App\Http\Controllers\Superadmin\DataUserController as SUDataUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('teacher/surat-masuk/index/get/{id}', [TSuratMasukController::class, 'getData'])->name('teacher.suratmasuk.index.get');
Route::get('teacher/surat-keluar/index/get/{id}', [TSuratKeluarController::class, 'getData'])->name('teacher.suratkeluar.index.get');
Route::get('staff/surat-masuk/index/get/{id}', [STSuratMasukController::class, 'getData'])->name('staff.suratmasuk.index.get');
Route::get('staff/surat-keluar/index/get/{id}', [STSuratKeluarController::class, 'getData'])->name('staff.suratkeluar.index.get');
Route::get('admin/surat-masuk/index/search={detail}', [ASuratMasukController::class, 'getSearch'])->name('admin.suratmasuk.index.search');
Route::get('admin/surat-masuk/index/get', [ASuratMasukController::class, 'getData'])->name('admin.suratmasuk.index.get');
Route::get('admin/disposisi/index/search={detail}', [ADispositionController::class, 'getSearch'])->name('admin.disposisi.index.search');
Route::get('admin/disposisi/index/get', [ADispositionController::class, 'getData'])->name('admin.disposisi.index.get');
Route::get('admin/surat-keluar/index/get/{id}', [ASuratKeluarController::class, 'getData'])->name('admin.suratkeluar.index.get');
Route::get('admin/surat-keluar/index/search={detail}/{id}', [ASuratKeluarController::class, 'getSearch'])->name('admin.suratkeluar.index.search');
Route::get('admin/perbaikan-surat/index/get/{id}', [APerbaikanSuratController::class, 'getData'])->name('admin.perbaikansurat.index.get');
Route::get('admin/perbaikan-surat/index/search={detail}/{id}', [APerbaikanSuratController::class, 'getSearch'])->name('admin.perbaikansurat.index.search');
Route::get('headmaster/surat-masuk/index/get/{id}', [HSuratMasukController::class, 'getData'])->name('headmaster.suratmasuk.index.get');
Route::get('headmaster/disposisi/index/get/{id}', [HDispositionController::class, 'getData'])->name('headmaster.disposisi.index.get');
Route::get('headmaster/surat-keluar/index/get', [HSuratKeluarController::class, 'getData'])->name('headmaster.suratkeluar.index.get');
Route::get('headmaster/perbaikan-surat/index/get', [HPerbaikanSuratController::class, 'getData'])->name('headmaster.perbaikansurat.index.get');
Route::get('student/perbaikan-surat/index/get/{id}', [SPerbaikanSuratController::class, 'getData'])->name('student.perbaikansurat.index.get');
Route::get('superadmin/role/index/get', [SURoleController::class, 'getData'])->name('superadmin.role.index.get');
Route::get('superadmin/datauser/index/get', [SUDataUserController::class, 'getData'])->name('superadmin.datauser.index.get');
