<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/uploadentry', 'FrontendController@uploadEntry')->name('uploadentry');
Route::get('/themes', 'FrontendController@themes')->name('themes');
Route::get('/funding', 'FrontendController@funding')->name('funding');
Route::get('/process', 'FrontendController@process')->name('process');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::get('/disclaimer', 'FrontendController@disclaimer')->name('disclaimer');
Route::get('/downloadform', 'FrontendController@downloadform')->name('downloadform');
Route::post('/submitcontact', 'FrontendController@submitContact')->name('submitcontact');
Route::post('/submitproposal', 'FrontendController@submitProposal')->name('submitproposal');
Route::get('/submitsuccess', 'FrontendController@submitSuccess')->name('submitsuccess');
Route::get('/contactsuccess', 'FrontendController@contactsuccess')->name('contactsuccess');
Route::get('/download/{filename}', function($filename)
{
    // Check if file exists in app/storage/file folder
    $file_path = storage_path() .'/file/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+');



//Route::get('macros', 'FrontendController@macros')->name('macros');

/**
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
	Route::group(['namespace' => 'User', 'as' => 'user.'], function() {
		/**
		 * User Dashboard Specific
		 */
		Route::get('dashboard', 'DashboardController@index')->name('dashboard');

		/**
		 * User Account Specific
		 */
		Route::get('account', 'AccountController@index')->name('account');

		/**
		 * User Profile Specific
		 */
		Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
	});
});