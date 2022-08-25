<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KabagController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\DosenpjController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SertifikatController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/handlelogin', [LoginController::class, 'handlelogin'])->name('handlelogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// route super admin
Route::group(['middleware' => ['auth:admin', 'cekLevel:0']], function () {
    Route::get('/dashboard', [AdminsController::class, 'index'])->name('DashboardAdmin');
    //route menu dosen pj
    Route::get('/dashboard/dosen-pj', [AdminsController::class, 'listDosenPj'])->name('ListDosenPj');
    Route::get('/dashboard/create-dosen-pj', [AdminsController::class, 'FormCreateDosenPj'])->name('FormCreateDosenPj');
    Route::post('/dashboard/create-dosen-pj', [AdminsController::class, 'handlecreatedosenpj'])->name('handlecreatedosenpj');
    Route::post('/dashboard/destroydosenpj', [AdminsController::class, 'destroydosenpj'])->name('destroydosenpj');
    Route::get('/dashboard/dosenpj/{id}', [AdminsController::class, 'formeditdosenpj'])->name('formeditdosenpj');
    Route::post('/dashboard/dosenpj/{id}', [AdminsController::class, 'editdosenpj'])->name('editdosenpj');
    //route menu kabag
    Route::get('/dashboard/kabag', [AdminsController::class, 'listkabag'])->name('ListKabag');
    Route::get('/dashboard/create-kabag', [AdminsController::class, 'FormCreateKabag'])->name('FormCreateKabag');
    Route::post('/dashboard/create-kabag', [AdminsController::class, 'handlecreateKabag'])->name('handlecreateKabag');
    Route::post('/dashboard/destroykabag', [AdminsController::class, 'destroykabag'])->name('destroykabag');
    Route::get('/dashboard/kabag/{id}', [AdminsController::class, 'formeditkabag'])->name('formeditkabag');
    Route::post('/dashboard/kabag/{id}', [AdminsController::class, 'editkabag'])->name('editkabag');
    //route menu user mahasiswa
    Route::get('/dashboard/mahasiswa', [AdminsController::class, 'listMahasiswa'])->name('ListMahasiswa');
    Route::get('/dashboard/create-mahasiswa', [AdminsController::class, 'FormCreateMahasiswa'])->name('FormCreateMahasiswa');
    Route::post('/dashboard/create-mahasiswa', [AdminsController::class, 'handlecreateMahasiswa'])->name('handlecreateMahasiswa');
    Route::post('/dashboard/destroymahasiwa', [AdminsController::class, 'destroyMahasiswa'])->name('destroyMahasiswa');
    Route::get('/dashboard/mahasiswa/{id}', [AdminsController::class, 'formeditMahasiswa'])->name('formeditMahasiswa');
    Route::post('/dashboard/mahasiswa/{id}', [AdminsController::class, 'editMahasiswa'])->name('editMahasiswa');
});

//route dosen pj
Route::group(['middleware' => ['auth:admin', 'cekLevel:1']], function () {
    Route::get('/dosenpj/dashboard', [DosenpjController::class, 'index'])->name('DashboardDosenPj');
    Route::get('/dosenpj/sertifikat/list', [DosenpjController::class, 'listsertifikat'])->name('ListSemuaSertifikatProdi');
    Route::post('/dosenpj/sertifikat/verifikasi', [DosenpjController::class, 'verifikasi'])->name('VerifikasiSertifikat');
});

//route kabag
Route::group(['middleware' => ['auth:admin', 'cekLevel:2']], function () {
    Route::get('/kabag/dashboard', [KabagController::class, 'index'])->name('DashboardKabag');
    Route::get('/kabag/sertifikat/list', [KabagController::class, 'ListSemuaSertifikatKabag'])->name('ListSemuaSertifikatKabag');
    Route::get('/kabag/sertifikat/list/cetak', [KabagController::class, 'cetak_pdf'])->name('cetak_pdf');
    Route::get('/kabag/sertifikat/list/templatecetak', [KabagController::class, 'template_pdf'])->name('template_pdf');
});

//route Mahasiswa
Route::group(['middleware' => ['auth']], function () {
    Route::get('/mahasiswa/home', [MahasiswaController::class, 'index'])->name('HomeMahasiswa');
    Route::get('/mahasiswa/sertifikat/list', [SertifikatController::class, 'index'])->name('ListSertifikat');
    Route::get('/mahasiswa/sertifikat/create', [SertifikatController::class, 'create'])->name('CreateSertifikat');
    Route::post('/mahasiswa/sertifikat/create', [SertifikatController::class, 'store'])->name('StoreSertifikat');
    Route::post('/mahasiswa/sertifikat/destroy', [SertifikatController::class, 'destroy'])->name('DestroySertifikat');
    Route::post('/mahasiswa/sertifikat/show', [SertifikatController::class, 'show'])->name('ShowSertifikat');
    Route::post('/mahasiswa/sertifikat/update', [SertifikatController::class, 'update'])->name('UpdateSertifikat');
});
