<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\NewsletterController;

Route::get('/',[HomeController::class,'index']);

Route::post('login_action',[UserController::class,'login_action']);
Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
   Route::get('dashboard',[HomeController::class,'dashboard']); 
   Route::resource('usergroup', UserGroupController::class);
   Route::resource('customers', CustomerController::class);
   Route::get('customersbulk', [CustomerController::class,'bulkupload']); 
   Route::post('getcsvfile', [CustomerController::class,'getcsvfile']);
   Route::resource('newsletter', NewsletterController::class);
   Route::resource('jobs', QueueController::class);
   Route::post('forcejob', [QueueController::class,'forcejob']);
});

// Test Que

Route::get('test', function(){
  
	$send_mail = 'test@gmail.com';
  
    dispatch(new App\Jobs\NewsLetterMailJob(1,$send_mail));
  
    dd('send mail successfully !!');
});
