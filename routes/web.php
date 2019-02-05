<?php

Route::get('/','Controller@home')->name('home');
Route::get('/Sample','Controller@GetSamples')->name('getsamples');
Route::post('/submit','Controller@Submit')->name('submit');
Route::post('/submitQuestion','Controller@SubmitQuestion')->name('submitquestion');
