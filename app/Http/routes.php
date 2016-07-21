<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/                                    
use App\Category;
use App\Product;
//use App\Search;
use App\User;
use Bican\Roles\Models\Role;
    
View::composer('public.includes.nav', function($view) {
    $category = Category::tree();
    return $view->with('category', $category);
});

//Public

Route::group(['prefix' => 'demo'], function() {
    
    //echo HTML::link(route('admin.users.getCreateUser'), 'Create User');
    Route::get('/role', function() {
       User::create([
            'name' => 'Nguyễn Trọng Hiếu',
            'username' => 'hieunt',
            'email' => 'chienmadondoc@gmail.com',
            'phone_number'  => '0981 945 175',
            'password' => bcrypt('tronghieu'),
        ]);
    });

    Route::get('/pass', function() {
        echo bcrypt('tronghieuok');
    });

    Route::get('/permission', function() {

    });

    Route::get('check-role', 'Admin\UserController@checkrole');

});



Route::get('/', ['as' => 'public.getIndex', 'uses' => 'HomeController@getIndex']);

Route::post('/ajax', ['as' => 'public.home.ajaxGetTab', 'uses' => 'HomeController@ajaxGetTab']);

// product

Route::get('/products/{id}/{title}', ['as' => 'public.products.getIndex', 'uses' => 'Product_detailController@getIndex'])->where(['id' => '[0-9]+', 'title' => '[a-zA-Z0-9._\-]+']);

// Cart

Route::get('/carts', [ 'as' => 'public.carts.getIndex', 'uses' => 'CartController@getIndex']);

Route::post('/carts/add', ['as' => 'public.carts.addCart', 'uses' => 'CartController@addCart']);

Route::post('carts/update', ['as' => 'public.carts.update', 'uses' => 'CartController@update']);

Route::post('carts/clear', ['as' => 'public.carts.clearCart', 'uses' => 'CartController@clearCart']);

Route::post('carts/delitem', ['as' => 'public.carts.delItem', 'uses' => 'CartController@delItem']);

// Order

Route::group(['prefix' => 'orders'], function() {

    Route::post('/postForm', ['as' => 'public.orders.postForm', 'uses' => 'OrderController@postForm']);

    Route::post('/end', ['as' => 'public.orders.postEnd', 'uses' => 'OrderController@postEnd']);

    Route::get('/end', ['as' => 'public.orders.end', 'uses' => 'OrderController@end']);

    Route::get('/success', ['as' => 'public.orders.success', 'uses' => 'OrderController@success']);

    Route::get('/', ['as' => 'public.orders.getIndex', 'uses' => 'OrderController@getIndex']);
});


// Categories

Route::get('/categories/{id}', ['as' => 'public.categories.getIndex', 'uses' => 'CategoryController@getIndex'])->where(['id' => '[0-9]+']);

Route::group(['prefix' => 'searchs'], function() {

    Route::get('/', ['as' => 'public.searchs.getIndex', 'uses' => 'Product_detailController@searchs']);
});

// route user public

Route::group(['prefix' => 'user'], function() {

    Route::get('/login', ['as' => 'public.users.getLLogin', 'uses' => 'UserController@getLLogin']);

    Route::get('/login', ['as' => 'public.users.postLogin', 'uses' => 'UserController@postLogin']);

    Route::get('/logout', ['as' => 'public.users.getLogout', 'uses' => 'UserController@getLogout']);

    Route::get('/register', ['as' => 'public.uses.getRegister', 'uses' => 'UserController@getRegister']);

    Route::post('/register', ['as' => 'public.uses.postRegister', 'uses' => 'UserController@postRegister']);

    Route::get('/register/success', ['as' => 'public.users.success', 'uses' => 'UserController@success']);

    Route::get('/', ['as' => 'public.users.getIndex', 'uses' => 'UserController@getIndex']);
});

// Admin

Route::get('/admin/logout', [ 'as' => 'admin.logout.getLogout', 'uses' => 'Admin\UserController@getLogout']);

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'guest'], function() {

        Route::controller('/login', 'Admin\UserController', [
            'getLogin' => 'admin.login.getLogin',
            'postLogin' => 'admin.login.postLogin',
        ]);
    });

    Route::group(['middleware' => 'auth'], function() {

        Route::controller('/categories', 'Admin\CategoryController', [
        	'getIndex' => 'admin.categories.getIndex',
        	'getForm'	=> 'admin.categories.getForm',
        	'postForm'	=> 'admin.categories.postForm',
        	'getDel'	=> 'admin.categories.getDel'
        ]);

        Route::controller('/products', 'Admin\ProductController', [
        	'getIndex' => 'admin.products.getIndex',
            'getFormAdd'   => 'admin.products.getFormAdd',
            'postFormAdd'  => 'admin.products.postFormAdd',
            'getFormEdit'   => 'admin.products.getFormEdit',
            'postFormEdit'  => 'admin.products.postFormEdit',
            'postDel'    => 'admin.products.postDel',
            // ajax
            'postCategories' => 'admin.products.postCategories',
            //set Image
            'getSetImage' => 'admin.products.getSetImage',

        ]);

        Route::controller('/parameters', 'Admin\ParameterController', [
        	'getIndex' => 'admin.parameters.getIndex',
        	'getForm'  => 'admin.parameters.getForm',
        	'postForm' => 'admin.parameters.postForm',
        	'getDel'   => 'admin.parameters.getDel'
        ]);

        Route::controller('/sizes', 'Admin\SizeController', [
            'getIndex'  => 'admin.sizes.getIndex',
            'getForm'   => 'admin.sizes.getForm',
            'postForm'  => 'admin.sizes.postForm',
            'getDel'    => 'admin.sizes.getDel'
        ]);

        Route::controller('/colors', 'Admin\ColorController', [
        	'getIndex'     => 'admin.colors.getIndex',
        	'getForm'	=> 'admin.colors.getForm',
        	'postForm'	=> 'admin.colors.postForm',
        	'getDel'	=> 'admin.colors.getDel'
        ]);

        // modules search

        Route::controller('/setting/search', 'Admin\SearchController', [
            'getIndex'  => 'admin.searchs.getIndex',
            'getForm'   => 'admin.searchs.getForm',
            'postForm'  => 'admin.searchs.postForm',
            'getEdit'   => 'admin.searchs.getEdit',
            'postEdit'  => 'admin.searchs.postEdit',
            'postDel'   => 'admin.searchs.postDel'
        ]);

        Route::controller('/users', 'Admin\UserController', [
            'getIndex'  => 'admin.users.getIndex',
            'getForm'   => 'admin.users.getForm',
            'postForm'  => 'admin.users.postForm',
            'getEdit'   => 'admin.users.getEdit',
            'postEdit'  => 'admin.users.postEdit',
            'postPass'  => 'admin.users.postPass',
            'postInfo'  => 'admin.users.postInfo',
            'postImg'   => 'admin.users.postImg'
        ]);

        Route::controller('/orders', 'Admin\OrderController', [
            'getIndex'  => 'admin.orders.getIndex',
            'postCheck' => 'admin.orders.postCheck',
            'getDetail' => 'admin.orders.getDetail'
        ]);

        Route::controller('/', 'Admin\AdminController', [
        	'getIndex' => 'admin.getIndex'
        ]);
    });
});


