<?php

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

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => '/auth', 'namespace' => 'Api'], function() {

        Route::post('/signup','AuthController@register');

        Route::post('/login','AuthController@login');

        Route::post('/logout','AuthController@logout');

        Route::post('/reset','AuthController@resetPassword');

        Route::post('/recover','AuthCOntroller@recoverPassword');

        Route::group(['middleware' => 'jwt.auth'], function() {

            Route::post('/refresh', 'AuthController@refresh');

            Route::get('/me', 'AuthController@me');
        });
    });

    Route::group(['middleware' => 'jwt.auth'], function() {
        Route::resource('user-list', 'Api\UserList\UserListController')->except([
            'create', 'edit'
        ]);

        Route::namespace('Api\\Places')->group(function() {
            Route::get('places', 'PlaceController@getCollection')->name('getPlaceCollection');
            Route::get('places/{id}', 'PlaceController@getPlace')
                ->where('id', '[0-9]+')
                ->name('getPlace');
            Route::post('places', 'PlaceController@addPlace')->name('addPlace');
            Route::put('places/{id}', 'PlaceController@updatePlace')
                ->where('id', '[0-9]+')
                ->name('updatePlace');
            Route::delete('places/{id}', 'PlaceController@removePlace')
                ->where('id', '[0-9]+')
                ->name('removePlace');
        });

        Route::post('/places/{id}/like', 'Api\LikeController@likePlace')->name('place.like');
        Route::post('/places/{id}/dislike', 'Api\DislikeController@dislikePlace')->name('place.dislike');

        Route::get('/places/features/', 'Api\Places\PlaceFeaturesController@indexPlaceFeature')
            ->name('place.features.indexFeature');

        Route::post('/places/features', 'Api\Places\PlaceFeaturesController@storePlaceFeature')
            ->name('place.features.storeFeature');

        Route::get('/places/features/{id}', 'Api\Places\PlaceFeaturesController@showPlaceFeature')
            ->name('place.features.showFeature');

        Route::delete('/places/features/{id}', 'Api\Places\PlaceFeaturesController@destroyPlaceFeature')
            ->name('place.features.deleteFeature');

        Route::get('/users/{userId}/info/', 'Api\Users\UserInfoController@show')
            ->name('user.info.show');
        Route::put('/users/{userId}/info/', 'Api\Users\UserInfoController@update')
            ->name('user.info.update');
        /* Routes here.. */
    });
});