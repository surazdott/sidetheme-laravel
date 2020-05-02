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

Auth::routes([
	'verify' => true,
	'register' => false,
]);

// Admin Routes
Route::get('/admin', 'DashboardController@index')->name('dashboard');
Route::group(['prefix' => 'admin', 'middleware' => 'verified'], function(){
	// Dashboard Routes
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::group(['middleware' => 'admin'], function(){
		// Categories Routes
		Route::get('/categories', 'CategoriesController@index')->name('categories');
		Route::get('/category/create', 'CategoriesController@create')->name('category.create');
		Route::post('/category/store', 'CategoriesController@store')->name('category.store');
		Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category.edit');
		Route::post('/category/update/{id}', 'CategoriesController@update')->name('category.update');
		Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('category.delete');
		// Item Routes
		Route::get('/items', 'ItemsController@index')->name('items');
		Route::get('/item/create', 'ItemsController@create')->name('item.create');
		Route::post('/item/store', 'ItemsController@store')->name('item.store');
		Route::get('/item/edit/{id}', 'ItemsController@edit')->name('item.edit');
		Route::post('/item/update/{id}', 'ItemsController@update')->name('item.update');
		Route::post('/item/delete', 'ItemsController@delete')->name('item.delete');
		Route::get('/item/trashed', 'ItemsController@trashed')->name('item.trashed');
		Route::post('/item/restore', 'ItemsController@restore')->name('item.restore');
		Route::get('/item/destroy/{id}', 'ItemsController@destroy')->name('item.destroy');
		// Comment Routes
		Route::get('/comments', 'CommentsController@index')->name('comments');
		Route::get('/comment/edit/{id}', 'CommentsController@edit')->name('comment.edit');
		Route::post('/comment/update/{id}', 'CommentsController@update')->name('comment.update');
		Route::post('/comment/delete', 'CommentsController@destroy')->name('comment.delete');
		// Tags Routes
		Route::get('/tags', 'TagsController@index')->name('tags');
		Route::get('/tag/create', 'TagsController@create')->name('tag.create');
		Route::post('/tag/store', 'TagsController@store')->name('tag.store');
		Route::get('/tag/edit/{id}', 'TagsController@edit')->name('tag.edit');
		Route::post('/tag/update/{id}', 'TagsController@update')->name('tag.update');
		Route::post('/tag/delete', 'TagsController@destroy')->name('tag.delete');
		// Adsense Routes
		Route::get('/adsense', 'AdsenseController@index')->name('adsense');
		Route::post('/adsense/update', 'AdsenseController@update')->name('adsense.update');
		// Mail Routes
		Route::get('/mails', 'MailsController@index')->name('mails');
		Route::get('/mail/send', 'MailsController@send')->name('mail.send');
		// User Routes
		Route::get('/pages', 'PagesController@index')->name('pages');
		Route::get('/page/create', 'PagesController@create')->name('page.create');
		Route::post('/page/store', 'PagesController@store')->name('page.store');
		Route::get('/page/edit/{id}', 'PagesController@edit')->name('page.edit');
		Route::post('/page/update/{id}', 'PagesController@update')->name('page.update');
		Route::get('page/delete/{id}', 'PagesController@destroy')->name('page.delete');
		// User Routes
		Route::get('/users', 'UsersController@index')->name('users');
		Route::get('/user/create', 'UsersController@create')->name('user.create');
		Route::post('/user/store', 'UsersController@store')->name('user.store');
		Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.edit');
		Route::post('/user/update/{id}', 'UsersController@update')->name('user.update');
		Route::get('user/delete/{id}', 'UsersController@destroy')->name('user.delete');
		// User Password Change
		Route::get('/password/change', 'UsersController@changePassword')->name('password.change');
		Route::post('/password/update', 'UsersController@updatePassword')->name('password.update');
		// Settings Routes
		Route::get('/settings', 'SettingsController@index')->name('settings');
		Route::post('/settings/update', 'SettingsController@update')->name('settings.update');
		// User Password Change
		Route::get('/profile', 'UsersController@profile')->name('profile');
		Route::post('/profile/update', 'UsersController@updateProfile')->name('profile.update');
		// Clear Cache
		Route::group(['prefix' => 'clear'], function(){
			Route::get('/view', 'DashboardController@clearView')->name('clear.view');
			Route::get('/route', 'DashboardController@clearRoute')->name('clear.route');
			Route::get('/config', 'DashboardController@clearConfig')->name('clear.config');
			Route::get('/optimize', 'DashboardController@clearOptimize')->name('clear.optimize');
			Route::get('/auth', 'DashboardController@clearAuth')->name('clear.auth');
		});
		// Save Cache
		Route::group(['prefix' => 'save'], function(){
			Route::get('/view', 'DashboardController@saveCache')->name('save.view');
			Route::get('/route', 'DashboardController@saveRoute')->name('save.route');
			Route::get('/config', 'DashboardController@saveConfig')->name('save.config');
		});
	});
});

// FrondEnd Routes
Route::get('/', 'HomeController@index')->name('index');
Route::get('/category/{slug}', 'HomeController@category')->name('category');
Route::get('/item/{slug}', 'HomeController@item')->name('item');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag');
Route::get('/results', 'HomeController@search')->name('results');
Route::post('/comment/store', 'HomeController@commentStore')->name('comment.store');
Route::get('/demo/{slug}', 'HomeController@demo')->name('demo');
Route::post('item/download/{slug}', 'HomeController@download')->name('item.download');
// Contact Us
Route::get('/contact-us', 'HomeController@contactUs')->name('contact.us');
Route::post('/contact-us/send', 'HomeController@sendMessage')->name('message.send');
// Sitemaps
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap.xml/items', 'SitemapController@items');
Route::get('/sitemap.xml/categories', 'SitemapController@categories');
Route::get('/sitemap.xml/tags', 'SitemapController@tags');
Route::get('/sitemap.xml/pages', 'SitemapController@pages');
// Pages
Route::get('/{slug}', 'HomeController@page')->name('page');

// Post Method Error Validation
Route::fallback(function(){
    return \Response::view('errors.404');
});