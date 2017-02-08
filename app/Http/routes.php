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
Route::get('/','Home\HomeController@viewHome');
Route::post('/contactHome','Home\HomeController@contactSendHome');

Route::get('/about','Home\HomeController@viewAbout');
Route::get('/contact','Home\HomeController@viewContact');
Route::post('/contact','Home\HomeController@contactSend');
Route::get('/privacy','Home\HomeController@viewPrivacy');
Route::get('/terms','Home\HomeController@viewTerms');
Route::get('/add-services','Home\HomeController@viewAddServices');

Route::get('get/allcvdata','APIController@getCvData'); 


Route::post('register','UserController@register');
Route::get('/register/verification/{user_id}/{verification_code}', 'UserController@accountVerified');
Route::post('resume/home','Auth\AuthController@index');

Route::post('password/change','UserController@changePassword');
Route::get('password/reset/view','UserController@viewPassswordResetForm');
Route::post('password/reset','Auth\AuthController@reset');
Route::get('/password/reset/{user_id}/{reset_token}','Auth\AuthController@resetVerify');
Route::post('password/new','Auth\AuthController@resetPassword');

Route::get('user/create','UserController@viewForm');
Route::get('/logout','UserController@logout');

Route::post('register/password','UserController@accountSetPassword');

Route::get('/resume/create','Front\ResumeBuilderController@resumeBuilderView');
Route::post('step/personal','APIController@savePersonalInfo');
Route::get('get/personal','ResumeBuildController@getPersonalInfo');
Route::post('step/edit/personal','ResumeBuildController@editPersonalInfo');
Route::post('update/template','APIController@updateTemplateID');

Route::get('/webhook','SubscriptionController@webhook');
Route::post('/webhook','SubscriptionController@webhook');
Route::get('plans','SubscriptionController@viewPlans');


Route::group(['middleware' => 'auth'], function () {
    
    Route::group(['middleware' => 'verify:user'], function () 
    {
        Route::get('/dashboard','Front\ResumeBuilderController@dashboard'); 
        Route::get('/checkout', 'SubscriptionController@viewCheckout');
        Route::post('/checkout', 'SubscriptionController@viewCheckout');
        Route::post('/payment','SubscriptionController@payment');
        Route::post('step/profile','APIController@saveProfileDesc');
        Route::post('step/work','APIController@saveWork');
        Route::post('step/education','APIController@saveEducation');
        Route::post('step/skill','APIController@saveSkills');
        Route::post('step/resume/save','APIController@saveResumeName');

        Route::post('step/edit/skill','ResumeBuildController@editSkill');        
        Route::post('step/edit/profile','ResumeBuildController@editProfile');
        Route::post('step/edit/work','APIController@editWork');
        Route::post('step/edit/education','APIController@editEducation');
        Route::get('/resume/edit','APIController@editResume');
        Route::get('/resume/new','APIController@newResume');
        Route::get('step/delete/skill','ResumeBuildController@deleteSkill');
        Route::get('step/delete/work','APIController@deleteWork');
        Route::get('step/delete/education','APIController@deleteEducation');
        Route::post('step/delete/personal','ResumeBuildController@editPersonalInfo');
        Route::post('step/delete/profile','ResumeBuildController@editProfile');
        Route::get('delete/resume','ResumeBuildController@deleteResume');

        Route::get('get/work','ResumeBuildController@getWorkInfo');
        Route::get('get/education','ResumeBuildController@getEducation');
        Route::get('get/skills','ResumeBuildController@getSkills');        
        Route::get('get/profile','ResumeBuildController@getProfileDesc');


        Route::post('package/add','PackageController@addPackage');
        Route::post('package/edit','PackageController@editPackage');
        Route::post('package/edit/status','PackageController@editPackageStatus');
        Route::post('package/delete','PackageController@deletePackage');
        Route::get('package/get','PackageController@getPackage');
        Route::get('package/get/all','PackageController@getAllPackages');

        Route::get('jobs','ResumeBuildController@jobPositions');
        Route::get('userskill','ResumeBuildController@userSkills');

        Route::get('resume/all','UserController@userCreatedResumes');
        Route::get('/resume/download','UserController@generatePDF');
        
        
        Route::get('step/pay/{package_id}','SubscriptionController@payStep');
        Route::post('step/checkout','SubscriptionController@checkout');
        
        Route::get('settings','UserController@settings');
        Route::post('settings/update','UserController@settingUpdate');
        Route::get('send/email/{id}/{t_id}','UserController@viewSendEmail');
        Route::post('post/email','UserController@postEmail');
        
    });
    
    Route::group(['middleware' => 'verify:admin','prefix' =>'admin'], function () 
    {
        Route::get('dashboard','AdminController@allUsers');
        Route::get('settings','UserController@changePass');
        Route::post('settings/update','UserController@adminSettingUpdate');
        Route::get('user/status/{id}','AdminController@setUserStatus');
        Route::get('resumes/{id}','AdminController@allResumes');
        Route::get('/resume/download','UserController@generatePDF');
        Route::get('user/all','AdminController@users');
        Route::get('user/search','AdminController@searchUsers');
        Route::get('package/all','AdminController@packages');
        Route::get('package/status','AdminController@packageStatus');
    });
});




