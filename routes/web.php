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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/contactus', function () {
    return view('contactus');
});

// Admin.Products

Route::get('/admin/products', 'ProductController@Index');

Route::get('/admin/products/create', 'ProductController@Create');

Route::post('/admin/products/create', 'ProductController@Store');

Route::get('/admin/products/delete/{id}', 'ProductController@Delete');

Route::delete('/admin/products/delete', 'ProductController@Remove');

Route::get('/admin/products/edit/{id}', 'ProductController@Edit');

Route::post('/admin/products/edit', 'ProductController@Update');

Route::get('/admin/products/{id}', 'ProductController@Show');

// ProductsStore

Route::get('/products', 'ProductController@ProductStore')->name('ProductStore');

Route::get('/products/{id}', 'ProductController@Details')->name('ProductDetails');

Route::post('/products/comment', 'ProductController@AddComment')->name('ProductComment');

Route::get('/mongodb', function () {
    return view('mongodb');
});
Route::get('/custom/mongo/login', 'MongoController@login');
// Categories
Route::get('/admin/categories', 'CategoryController@index')->name('categories');

Route::post('/admin/categories/create', 'CategoryController@create')->name('createCategory');

Route::post('/admin/categories/edit/{id}', 'CategoryController@edit')->name('editCategory');

Route::delete('/admin/categories/delete/{id}', 'CategoryController@delete')->name('deleteCategory');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
