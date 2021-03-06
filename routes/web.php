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

Route::get('/', function () {
    return view('home');    
});

Route::prefix('dashboard')->group(function () {
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::resource('users', 'UserController');
	Route::resource('roles', 'RoleController');
	Route::resource('jurusans', 'JurusanController');
	Route::resource('siswa', 'SiswaController');
	Route::resource('post', 'PostController');
	Route::resource('pengumumans', 'PengumumanController');
	Route::resource('materis', 'MateriController');
	Route::get('detail-materi/{id?}/create', 'MateriController@create_detail')->name('detail-materi');
	Route::get('detail-materi/{id?}/{ids?}/edit', 'MateriController@edit_detail')->name('detail-materi.edit');
	Route::post('detail-materi/{id?}', 'MateriController@post_detail');
	Route::put('detail-materi/{id?}/{ids?}', 'MateriController@update_detail')->name('detail-materi.update');
	Route::patch('detail-materi/{id?}/{ids?}', 'MateriController@update_detail')->name('detail-materi.update');
	Route::delete('detail-materi/{id?}/{ids?}', 'MateriController@destroy_detail')->name('detail-materi.destroy');
	Route::get('report', 'MateriController@report')->name('report');
	Route::post('report', 'MateriController@post_report');
	Route::post('submit-activity', 'MateriController@store_activity');
	Route::get('review-materi/{id?}', 'MateriController@review')->name('review-materi');
	Route::get('dashboard-siswa', 'DashboardController@post')->name('dashboard-siswa');
	Route::get('jadwal', 'DashboardController@jadwal')->name('jadwal');
	Route::get('jurnal', 'DashboardController@jurnal')->name('jurnal');
	Route::get('kejadian', 'DashboardController@kejadian')->name('kejadian');
	Route::get('profile', 'DashboardController@profile')->name('profile');
	Route::get('home', 'DashboardController@home')->name('home');
	Route::get('materi/{id?}', 'DashboardController@materi')->name('materi');
	Route::post('siswa/import', 'SiswaController@import');
	Route::post('siswa/kelas', 'SiswaController@kelas');
	Route::get('materi-pertama', 'DashboardController@materi_satu')->name('materi-pertama');

	Route::get('klear', function(){
		\Artisan::call('view:clear');
        \Artisan::call('cache:clear');        
	});	
});

Auth::routes();
Route::get('/login', function () {
    return view('home');
});
Route::get('/register', function () {
    return view('register');
});
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\LoginController@register')->name('register');
Route::get('activate', 'Auth\LoginController@activate');
/*Route::get('register', function(){
	return redirect('/');
});*/
Route::get('reset-password', 'Auth\ForgotPasswordController@reset');
/*Route::get('activate', 'Auth\LoginController@activate');
Route::get('activate_customer', 'Auth\LoginController@activate_customer');
Route::get('activate_driver', 'Auth\LoginController@activate_driver');*/
Route::get('password/result', 'Auth\ForgotPasswordController@result');
Route::get('result', 'Auth\ForgotPasswordController@result');
Route::get('result', 'Auth\ForgotPasswordController@resulte');
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testing', 'HomeController@testing');

Route::get('jajal', 'CbtController@jajal');

Route::get('sinkron/{id}', 'SinkronController@index');
Route::get('progress-sinkron/{id}', 'SinkronController@sinkron');

Route::get('read-login', 'HomeController@login');
Route::get('deploy', 'HomeController@deploy');
Route::get('artisan', 'HomeController@artisan');
Route::get('read/{slug}', 'HomeController@read');
Route::get('/{slug}', function ($slug) {  
  return App::make('\App\Http\Controllers\HomeController')->detail($slug);  
});
//testing komen
//testing lagi
//testing sekali lagi