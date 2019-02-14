<?php

Route::get('/','Controller@home')->name('home');
Route::get('/public','Controller@getSamples')->name('samples');
Route::get('/public/rates','Controller@getRatings')->name('rates');
Route::post('/submit','Controller@Submit')->name('submit');
Route::post('/submitQuestion','Controller@SubmitQuestion')->name('submitquestion');
Route::post('/submitRatings','Controller@SubmitRatings')->name('submitrating');