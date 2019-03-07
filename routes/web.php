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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/browserstack', 'BrowserstackController@index')->name('browserstack');


Route::get('/documentation', 'HomeController@docs')->name('docs');

Route::get('/leaseweb', 'LeaseController@index')->name('leaseweb');

Route::get('/pixel', 'PixelController@index')->name('pixel');

Route::get('/mouseflow', 'MouseflowController@index')->name('Mouseflow');



Route::get('/getmonday', 'Monday@index')->name('getmonday');


Route::get('/monday/api/save', 'Monday@SaveApi')->name('SaveApi');

Route::post('/monday/api/save', 'Monday@SaveApi')->name('SaveApi');



Route::get('/test', 'PageTests@testUno')->name('index');

Route::get('/isalive', 'PageTests@CheckAlive')->name('alive');


/* End General Routes */

/*API LeaseWeb */
/*
Route::get('/leaseweb/customers/all', 'LeaseController@getAllCustomers')->name('getAllCustomers');
Route::get('/leaseweb/zones/all', 'LeaseController@getOrigins')->name('getOrigins');
*/


Route::get('/leaseweb/purge/{zone_id}', 'LeaseController@PurgeZone')->name('purge');





Route::prefix('iframe')->group(function(){
    Route::get('/', 'PixelController@index');
    Route::get('/iFrameindex', 'PixelController@index');

    //Route::get('/create', 'PixelController@showCreate');

    Route::post('/create', 'PixelController@saveiframe');


    Route::post('/validation', 'PixelController@validation');

    //Route::post('/save', 'PixelController@saveiframe');

    Route::get('/showframe/{id}', 'PixelController@showIframe');

    Route::get('/editiframe/{id}', 'PixelController@editframe');


    /*Editar Cambios a iframe pixel */
    Route::put('/update', 'PixelController@edit');

    Route::get('/delete/{id}', 'PixelController@deleteIframe');
    Route::get('/link/{id}', 'PixelController@link');
  });
  
  Route::prefix('pixel')->group(function(){
    Route::get('/view/{hash}', 'PixelController@LinkPublic');

   // Route::get('/view/{id}', 'PixelController@seeyou');
  });


  Route::get('/mouseflow', 'MouseflowController@index')->name('mouseflow');


  
