<?php

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
Route::middleware(['belum_login'])->group(function () {
    // guru
    Route::get('guru', 'DashboardController@index')->name('guru');
    Route::get('regis_guru', 'DashboardController@register_guru')->name('regis_guru');
    Route::post('aksi_r_guru', 'DashboardController@registerGuru')->name('aksi_r_guru');
    Route::post('aksi_l_guru', 'DashboardController@loginAdmin')->name('aksi_l_guru');

    Route::get('/', 'DashboardController@index')->name('/');
    Route::post('aksilogin', 'DashboardController@loginAdmin')->name('aksilogin');
});

Route::middleware(['sudah_login'])->group(function () {
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('tabel', 'DashboardController@tabel')->name('tabel');
    Route::get('logout', 'DashboardController@logout')->name('logout');

    // user
    Route::get('user', 'UserController@index')->name('user');
    Route::get('user/create', 'UserController@create')->name('user.create');
    Route::post('user', 'UserController@store')->name('user.store');
    Route::get('user/{user}', 'UserController@edit')->name('user.edit');
    Route::put('user/{user}', 'UserController@update')->name('user.update');
    Route::delete('user/{user}', 'UserController@destroy')->name('user.delete');

    // Guru
    // semester
    Route::get('semester', 'SemesterController@index')->name('semester');
    Route::get('semester/create', 'SemesterController@create')->name('semester.create');
    Route::post('semester', 'SemesterController@store')->name('semester.store');
    Route::get('semester/{semester}', 'SemesterController@edit')->name('semester.edit');
    Route::put('semester/{semester}', 'SemesterController@update')->name('semester.update');
    Route::delete('semester/{semester}', 'SemesterController@destroy')->name('semester.delete');

    // materi
    Route::get('materi', 'MateriController@index')->name('materi');
    Route::get('materi/create', 'MateriController@create')->name('materi.create');
    Route::post('materi', 'MateriController@store')->name('materi.store');
    Route::get('materi/{materi}', 'MateriController@edit')->name('materi.edit');
    Route::put('materi/{materi}', 'MateriController@update')->name('materi.update');
    Route::delete('materi/{materi}', 'MateriController@destroy')->name('materi.delete');
    // kelas
    Route::get('kelas/get/{id}', 'MateriController@getKelas');

    // tugas
    Route::get('tugas', 'TugasController@index')->name('tugas');
    Route::get('tugas/create', 'TugasController@create')->name('tugas.create');
    Route::post('tugas', 'TugasController@store')->name('tugas.store');
    Route::get('tugas/{tugas}', 'TugasController@edit')->name('tugas.edit');
    Route::put('tugas/{tugas}', 'TugasController@update')->name('tugas.update');
    Route::delete('tugas/{tugas}', 'TugasController@destroy')->name('tugas.delete');

    // kirim_tugas
    Route::get('kirim_tugas', 'KirimTugasController@index')->name('kirim_tugas');
    Route::get('kirim_tugas/create', 'KirimTugasController@create')->name('kirim_tugas.create');
    Route::post('kirim_tugas', 'KirimTugasController@store')->name('kirim_tugas.store');
    Route::get('kirim_tugas/{kirim_tugas}', 'KirimTugasController@edit')->name('kirim_tugas.edit');
    Route::put('kirim_tugas/{kirim_tugas}', 'KirimTugasController@update')->name('kirim_tugas.update');
    Route::delete('kirim_tugas/{kirim_tugas}', 'KirimTugasController@destroy')->name('kirim_tugas.delete');

    // quis
    Route::get('quis', 'QuisController@index')->name('quis');
    Route::get('quis/create', 'QuisController@create')->name('quis.create');
    Route::get('quis/addcreate', 'QuisController@addCreate')->name('quis.addcreate');
    Route::post('quis', 'QuisController@store')->name('quis.store');
    Route::post('addstore/quis', 'QuisController@addStore')->name('quis.addstore');
    Route::get('quis/{quis}', 'QuisController@edit')->name('quis.edit');
    Route::put('quis/{quis}', 'QuisController@update')->name('quis.update');
    Route::delete('quis/{quis}', 'QuisController@destroy')->name('quis.delete');
    Route::post('cariquis', 'QuisController@cariQuis')->name('quis.cari');

    // nilai
    Route::get('nilai', 'NilaiController@index')->name('nilai');
    Route::get('nilai/create', 'NilaiController@create')->name('nilai.create');
    Route::post('nilai', 'NilaiController@store')->name('nilai.store');
    Route::get('nilai/{nilai}', 'NilaiController@edit')->name('nilai.edit');
    Route::put('nilai/{nilai}', 'NilaiController@update')->name('nilai.update');
    Route::delete('nilai/{nilai}', 'NilaiController@destroy')->name('nilai.delete');
    Route::post('carinilai', 'NilaiController@cariNilai')->name('nilai.cari');

    // izin
    Route::get('izin', 'IzinController@index')->name('izin');
    Route::get('izin/create', 'IzinController@create')->name('izin.create');
    Route::post('izin', 'IzinController@store')->name('izin.store');
    Route::get('izin/{izin}', 'IzinController@edit')->name('izin.edit');
    Route::put('izin/{izin}', 'IzinController@update')->name('izin.update');
    Route::delete('izin/{izin}', 'IzinController@destroy')->name('izin.delete');

    // jawaban
    Route::get('jawab', 'JawabController@index')->name('jawab');
    Route::get('jawab/create', 'JawabController@create')->name('jawab.create');
    Route::post('jawab', 'JawabController@store')->name('jawab.store');
    Route::post('jawab-detail', 'JawabController@detail')->name('jawab.detail');
    Route::delete('jawab/{jawab}', 'JawabController@destroy')->name('jawab.delete');

    
});
