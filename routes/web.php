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
    return view('ui.index');
});

Route::get('phim24_login', 'AdminController@getLogin')->name('getLogin'); 

Route::post('phim24_login', 'AdminController@postLogin')->name('postLogin');

Route::get('logout', 'AdminController@getLogout')->name('getLogout'); 

Route::middleware(['auth','revalidate'])->group(function () {
    Route::group(['prefix' => 'phim24_admin'], function() {
        Route::get('/', function(){
            return view('admin.dashboard.index');
        })->name('admin');

        Route::group(['prefix' => 'category'], function() {
            Route::get('list', 'AdminController@getListCate');
            Route::post('add', ['uses'=>'AdminController@AddCate']);
            Route::get('edit/{id}', ['uses'=>'AdminController@getEdit']);
            Route::post('edit/{id}', ['uses'=>'AdminController@postEdit']);
            Route::get('delete/{id}', ['uses'=>'AdminController@getDelete']);
            Route::get('type/{type}', ['uses'=>'AdminController@getType']);
        });

        Route::group(['prefix' => 'user', 'middleware' => 'admin'], function() {
            Route::get('/', function(){
                return view('admin.dashboard.user');
            })->name('user');
            Route::get('list', 'AdminController@getUserList');
            Route::post('add', 'AdminController@AddUser');
            Route::get('delete/{id}', 'AdminController@getUserDelete');
        });

        Route::group(['prefix' => 'info'], function() {
            Route::get('/', function(){
                return view('admin.dashboard.info');
            })->name('info');
            Route::get('movieNotExists', 'AdminController@getMovieNotExists');
            Route::post('add', 'AdminController@AddInfo');
            Route::post('uploadavtar', 'AdminController@AddPoster');
            Route::get('list', 'AdminController@getInfoList');
            Route::get('edit/{id}', 'AdminController@getInfoEdit');
            Route::post('edit/{id}', 'AdminController@postInfoEdit');
            Route::get('delete/{id}', 'AdminController@getInfoDelete');
        });
        
        Route::group(['prefix' => 'nation'], function() {
            Route::get('/', function(){
                return view('admin.dashboard.nation');
            })->name('nation');
            Route::get('list', 'AdminController@getListNation');
            Route::post('add', 'AdminController@AddNation');
            Route::get('edit/{id}','AdminController@getNationEdit');
            Route::post('edit/{id}','AdminController@postNationEdit');
            Route::get('delete/{id}', ['uses'=>'AdminController@getNationDelete']);
        });

        Route::group(['prefix' => 'movie'], function() {
            Route::get('/', function(){
                return view('admin.dashboard.movie');
            })->name('movie');
            Route::get('list', 'AdminController@getListMovie');
            Route::post('add', 'AdminController@AddMovie');
            Route::get('edit/{id}','AdminController@getMovieEdit');
            Route::post('edit/{id}','AdminController@postMovieEdit');
            Route::get('delete/{id}', ['uses'=>'AdminController@getMovieDelete']);
        });
        
        Route::group(['prefix' => 'link'], function() {
            Route::get('/', function(){
                return view('admin.dashboard.link');
            })->name('link');
            Route::get('list', 'AdminController@getListLink');
            Route::get('listPhimLe/{id}', 'AdminController@getLinkPhimLe');
            Route::get('listPhimBo/{id}', 'AdminController@getLinkPhimBo');
            Route::post('add', 'AdminController@AddLink');
            Route::get('edit/{id}','AdminController@getLinkEdit');
            Route::post('edit/{id}','AdminController@postLinkEdit');
            Route::get('delete/{id}', 'AdminController@getLinkDelete');
        });
    });
});
Route::group(['prefix' => 'phim24_ui'], function(){
    Route::group(['prefix' => 'menu'], function(){
        Route::get('listcategoryphimle', 'UIController@getListCategoryPhimLe');
        Route::get('listcategoryphimbo', 'UIController@getListCategoryPhimBo');
    });
});
