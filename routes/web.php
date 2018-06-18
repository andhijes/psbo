<?php

use App\Notifications\TutorialPublished;
use Illuminate\Support\Collection;
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

//Route::get('/', function () {
    //return view('welcome');
//});

Route::get('/', function () {
    return view('index');
});

//emaul all user with conditions
Route::get('/video', function() {
//$requirement = App\requirement::latest()->first();
$mytime = Carbon\Carbon::now();
$mytime = Carbon\Carbon::parse($mytime);
$mytime = $mytime->toDateString();

// $q = App\requirement::whereDate($mytime, '>', $requirement->getAttribute('deadline'));
// if($q) {
//   echo $requirement->getAttribute('id');
// }

foreach (App\requirement::all() as $requirement) {
  $deadline = $requirement->getAttribute('deadline');
//  $deadline = Carbon\Carbon::parse($deadline);
//  $q = App\requirement::where($mytime, '=', $deadline);
//  dd($q);
  if(Carbon\Carbon::parse($deadline)->gt($mytime)) {
      echo $requirement->getAttribute('id');
  }
}
// foreach (App\Userinfo::all() as $user) {
//   if($user->getAttribute('faculty') == $requirement->getAttribute('faculty') and
//   $user->getAttribute('gda') >= $requirement->getAttribute('gda') and
//   $user->getAttribute('semester') == $requirement->getAttribute('semester') and
//   $user->getAttribute('program') == $requirement->getAttribute('program')) {
//     $user->notify(new TutorialPublished($user));
//   }
// }
});

Route::get('login', function () {
    return view('login');
});

Route::get('register', function () {
    return view('register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::patch('/profile', 'AdminController@update')->name('admin.update');
    Route::post('/profile', 'AdminController@changePassword')->name('admin.password');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/addScholarship', 'ScholarshipController@create')->name('addScholarship.create');
    Route::post('/addScholarship', 'ScholarshipController@store')->name('addScholarship.store');
    Route::get('/student', 'StudentController@read')->name('student');
    Route::get('/scholarship', 'ScholarshipController@read')->name('scholarship.read');
    Route::get('/scholarshipView/{id}', 'ScholarshipController@view')->name('scholarship.view');
    Route::get('/editScholarship/{id}/edit', 'ScholarshipController@edit')->name('editScholarship.edit');
    Route::patch('/editScholarship/{id}/edit', 'ScholarshipController@update')->name('editScholarship.update');
    Route::delete('/editScholarship/{id}/delete', 'ScholarshipController@destroy')->name('editScholarship.destroy');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    // Route::post('/test', 'adminController@updatePhoto')->name('admin.updatePhoto');
    Route::get('/test', 'TagController@test')->name('admin.test');
    Route::get('/testview/{id}', 'TagController@testview')->name('admin.testview');
    Route::resource('tags', 'TagController', ['except'  => ['create']]);
});
