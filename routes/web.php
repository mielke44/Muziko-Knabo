<?php

Route::get('/','Controller@home')->name('home');
Route::get('/public','Controller@getSamples')->name('samples');
Route::post('/submit','Controller@Submit')->name('submit');
Route::post('/submitQuestion','Controller@SubmitQuestion')->name('submitquestion');