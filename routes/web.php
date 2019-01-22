<?php

Route::get('/','Controller@home')->name('home');
Route::post('/submit','Controller@Submit')->name('submit');
Route::post('/submitQuestion','Controller@SubmitQuestion')->name('submitquestion');