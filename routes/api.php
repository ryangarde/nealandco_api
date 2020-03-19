<?php

use Illuminate\Http\Request;

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

Route::post('login', 'AuthController@login');
Route::get('/testimonials', 'TestimonialsController@indexActive');

Route::group(['middleware' => 'auth:api'], function() {
  Route::get('user', 'AuthController@user');

  Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'testimonials'], function() {
      Route::get('/', 'TestimonialsController@index');
      Route::post('/', 'TestimonialsController@store');
      Route::put('/{testimonial}', 'TestimonialsController@update');
      Route::get('/{testimonial}', 'TestimonialsController@show');
      Route::delete('/{testimonial}', 'TestimonialsController@destroy');
    });
  });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });


