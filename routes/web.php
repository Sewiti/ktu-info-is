<?php

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

Route::get('/', 'HomeController@index')->name('home');


Route::get('kontaktai', function () {
    return view('contact');
});

// Route::get('kalendorius', function () {
//     return view('calendar');
// });
// Route::get('paslaugos/sukurti', function () {
//     return view('tasks.create');
// });
// Route::get('paslaugos/sukurti/uzsakymas', function () {
//     return view('payments.show');
// });
// Route::get('paslaugos/sukurti/uzsakymas/apmoketi', function () {
//     return view('payments.payment');
// });


Route::get('paslaugos/sekti', function () {
    return view('tasks.track');
});




// Vartotojai
Route::get('vartotojai', 'UsersController@index')
    ->middleware('role:Administratorius')
    ->name('users.index');

Route::get('prisijungimas', 'UsersController@login')
    ->middleware('guest')
    ->name('login');

Route::post('prisijungimas', 'Auth\LoginController@login')
    ->middleware(['guest', 'active'])
    ->name('login');

Route::post('atsijungti', 'Auth\LoginController@logout')
    ->middleware('auth')
    ->name('logout');

Route::get('registracija', 'UsersController@create')
    ->middleware('guest')
    ->name('register');

Route::post('registracija', 'Auth\RegisterController@register')
    ->name('register');

Route::get('vartotojai/{userId}', 'UsersController@show')
    ->middleware('auth')
    ->name('users.show');

Route::put('vartotojai/{userId}', 'UsersController@update')
    ->middleware('auth')
    ->name('users.update');

Route::put('vartotojai/{userId}/role', 'UsersController@updateRole')
    ->middleware('role:Administratorius')
    ->name('users.update.role');

Route::get('vartotojai/{userId}/redaguoti', 'UsersController@edit')
    ->middleware('auth')
    ->name('users.edit');

Route::delete('vartotojai/{userId}/salinti', 'UsersController@destroy')
    ->middleware('auth')
    ->name('users.destroy');

Route::get('pakvietimai', 'UsersController@invite')
    ->middleware('auth')
    ->name('users.invite');




Route::get('/paslaugos', 'TasksController@index')
    ->middleware('auth')
    ->name('tasks.index');

Route::get('/kalendorius', 'TasksController@showCalendar')
    ->middleware('auth')
    ->name('kalendorius.showCalendar');

Route::get('/uzduotys/sukurti/{date}', 'TasksController@create')
    ->middleware('auth')
    ->name('kalendorius.create');

Route::post('/uzduotys/{employee}', 'TasksController@store')
    ->middleware('auth')
    ->name('tasks.store');

Route::get('/paslaugos/{task}', 'TasksController@show')
    ->middleware('auth')
    ->name('tasks.show');

Route::post('/paslaugos/comms', 'TasksController@commsStore')
    ->middleware('auth')
    ->name('tasks.comms.store');

Route::get('/paslaugos/comms/{recipientId}', 'TasksController@comms')
    ->middleware('auth')
    ->name('tasks.comms');

Route::get('/paslaugos/redaguoti/{task}', 'TasksController@edit')
    ->middleware('auth')
    ->name('tasks.edit');

Route::put('/paslaugos/redaguoti/{task}', 'TasksController@update')
    ->middleware('auth')
    ->name('tasks.update');

Route::delete('/paslaugos/salinti/{task}', 'TasksController@destroy')
    ->middleware('auth')
    ->name('tasks.destroy');




Route::get('/prekes', 'PrekesController@index')->name('prekes.index');
Route::get('/prekes/sukurti', 'PrekesController@create')->middleware('role:Administratorius');
Route::post('/prekes', 'PrekesController@store')->name('prekes.store')->middleware('role:Administratorius');
Route::get('/prekes/{item}', 'PrekesController@show')->name('prekes.show');
Route::delete('/prekes/{item}', 'PrekesController@destroy')->name('prekes.destroy')->middleware('role:Administratorius');
Route::get('/prekes/{item}/edit', 'PrekesController@edit')->name('prekes.edit')->middleware('role:Administratorius');
Route::put('/prekes/{item}', 'PrekesController@update')->name('prekes.update')->middleware('role:Administratorius');




// Apmokėjimai
Route::post('/addToCart/{id}', 'CartController@store')->name('krepselis.store');
Route::get('/removeFromCart/{position}', 'CartController@delete')->name('krepselis.delete');
Route::get('/krepselis', 'CartController@index')->name('krepselis.index');
Route::get('/apmoketi', 'PaymentController@index')->name('apmokejimas.index');
Route::post('/apmoketi', 'PaymentController@store')->name('apmokejimas.store');
Route::get('/apmoketa', 'PaymentController@success')->name('apmokejimas.success');
Route::get('/neapmoketa', 'PaymentController@denied')->name('apmokejimas.denied');
Route::post('/callback', 'PaymentController@callback')->name('apmokejimas.callback');




// Užsakymai
Route::get('/uzsakymai', 'OrdersController@index')
    ->middleware('auth')
    ->name('uzsakymai.index');

Route::get('/uzsakymas/{id}', 'OrdersController@show')
    ->middleware('auth')
    ->name('uzsakymai.show');




// Būsena
Route::get('/busena', 'StatusController@index')->name('busena.index');
Route::post('/busena', 'StatusController@show')->name('busena.show');
Route::get('/keistiBusena/{id}/{status}', 'StatusController@update')->name('busena.update');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
