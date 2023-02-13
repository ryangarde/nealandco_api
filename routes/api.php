<?php

use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeaturedPropertiesController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertyImagesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestimonialsController;
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

Route::post('login', [AuthController::class, 'login']);
Route::get('/testimonials',[TestimonialsController::class, 'indexActive']);
Route::get('/featured-properties', [FeaturedPropertiesController::class, 'indexActive']);
Route::get('/properties', [PropertiesController::class, 'indexNotDone']);
Route::get('/properties/types', [PropertiesController::class, 'getTypes']);
Route::get('/properties/statuses', [PropertiesController::class, 'getStatuses']);
Route::get('/properties/prices', [PropertiesController::class, 'getPrices']);
Route::post('/properties/search', [PropertiesController::class, 'search']);
Route::get('/properties/{property}', [PropertiesController::class, 'show']);
Route::get('/properties/{property}/images', [PropertyImagesController::class, 'index']);
Route::get('/properties/image/{propertyImage}', [PropertyImagesController::class, 'showImage']);
Route::get('/properties/{property}/amenities', [AmenitiesController::class, 'index']);
Route::post('/mail/offer-property', [MailController::class, 'offerProperty']);
Route::post('/mail/book-a-viewing', [MailController::class, 'bookAViewing']);
Route::post('/mail/inquire-properties', [MailController::class, 'inquireProperties']);
Route::get('/settings', [SettingsController::class, 'show']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{blog}', [BlogController::class, 'show']);

Route::middleware(['api'])->group(function() {
    Route::get('user', [AuthController::class], 'user');

    Route::prefix('admin')->group(function() {
        Route::prefix('properties')->group(function() {
            Route::delete('/{property}/images/{propertyImage}', [PropertyImagesController::class, 'destroy']);
            Route::post('/{property}/images', [PropertyImagesController::class, 'store']);
            Route::get('/{property}/images', [PropertyImagesController::class, 'index']);

            Route::post('/{property}/amenities', [AmenitiesController::class, 'store']);
            Route::delete('/{property}/amenities/{amenity}', [AmenitiesController::class, 'destroy']);

            Route::get('/not-sold', [PropertiesController::class, 'indexNotDoneNoPaginate']);

            Route::get('/sold', [DashboardController::class, 'propertiesSold']);
            Route::get('/leased', [DashboardController::class, 'propertiesLeased']);

            Route::get('/{property}', [PropertiesController::class, 'show']);
            Route::post('/{property}', [PropertiesController::class, 'propertySold']);
            Route::put('/{property}', [PropertiesController::class, 'update']);
            Route::delete('/{property}', [PropertiesController::class, 'destroy']);
            Route::get('/', [PropertiesController::class, 'index']);
            Route::post('/', [PropertiesController::class, 'store']);
        });

        Route::prefix('testimonials')->group(function() {
            Route::apiResource('/', TestimonialsController::class);
            Route::post('/{testimonial}/image', [TestimonialsController::class, 'updateImage']);
        });

        Route::apiResource('blogs', BlogController::class);
        Route::apiResource('leads', LeadController::class);

        Route::prefix('featured-properties')->group(function() {
            Route::get('/', [FeaturedPropertiesController::class, 'index']);
            Route::post('/', [FeaturedPropertiesController::class, 'store']);
            Route::patch('/{property}', [FeaturedPropertiesController::class, 'storeOne']);
            Route::post('/{property}', [FeaturedPropertiesController::class, 'destroy']);
        });

        Route::prefix('settings')->group(function() {
            Route::get('/', [SettingsController::class, 'show']);
            Route::post('/set-email-receiver', [SettingsController::class, 'setEmailReceiver']);
            Route::post('/set-facebook-link', [SettingsController::class, 'setFacebookLink']);
            Route::post('/set-youtube-link', [SettingsController::class, 'setYoutubeLink']);
            Route::post('/set-instagram-link', [SettingsController::class, 'setInstagramLink']);
            Route::post('/set-twitter-link', [SettingsController::class, 'setTwitterLink']);
            Route::post('/set-linkedin-link', [SettingsController::class, 'setLinkedInLink']);
        });
    });
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
