<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'CsvFileController');
Route::post('/', 'CsvFileController@fileUpload')->name('fileUpload');
