<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});
 */

Route::post('registration', 'api\AuthController@registration');
Route::post('login', 'api\AuthController@login');

Route::post('forget-password', 'api\AuthController@forgetPassword');

Route::get('autocomplete-search', 'api\HomeController@searchForDropdown');

Route::get('employer/autocomplete-search', 'api\HomeController@searchForDropdownEmployer');

Route::get('search-job', 'api\HomeController@getSearchJob');

Route::get('country-list', 'api\HomeController@getCountryList');

Route::get('job-list-by-country/{country_name}', 'api\HomeController@getJobByCountry');

Route::get('job-by-id/{job_id}', 'api\HomeController@getJobById');

Route::get('common-data', 'api\HomeController@getCommonData');

Route::get('get-job-by-search', 'api\JobManageController@getJobBySearch');

Route::post('get-job-by-adv-search', 'api\JobManageController@getJobByAdvSearch');

Route::get('employer/get-cv-by-search', 'api\CvManageController@getCvByHomeSearch');
Route::post('employer/cv-search/get-cvs', 'api\CvManageController@getCvListBySearch');

Route::middleware('auth:api')->namespace('api')->group(function () {
	Route::get('logout', 'AuthController@logout');
	Route::post('employer-profile-update', 'AuthController@employerProfileUpdate');
	Route::post('employer-quick-profile-update', 'AuthController@employerQuickProfileUpdate');
	Route::get('employer-posted-job-list', 'JobManageController@index');
	Route::resource('employer/email-template', 'EmailTemplateController');
	Route::post('employer/email-template/deleteall', 'EmailTemplateController@deleteAll');
	//Route::post('employer-job-post','JobManageController@store');
	Route::resource('employer-job', 'JobManageController');
	Route::get('employer-job/status-change/{id}', 'JobManageController@jobStatus');

	Route::resource('walkin-interview', 'WalkInInterviewController');
	Route::get('walkin-interview/status-change/{id}', 'WalkInInterviewController@walkingStatus');

	Route::resource('employee-profile', 'ProfileController');
	Route::post('employee-profile/image-change', 'ProfileController@profileImageChange');
	Route::post('employee-profile/store-formdata', 'ProfileController@storeFormdata');
	Route::post('employee/resume-upload', 'ProfileController@uploadResume');
	Route::post('employee/video-upload', 'ProfileController@uploadVideo');
	Route::post('employee/image-upload', 'ProfileController@uploadPhoto');
	Route::post('employee/update-education', 'ProfileController@updateEducation');
	Route::delete('employee/delete-eudcation/{id}', 'ProfileController@deleteEducation');
	Route::post('employee/update-certification', 'ProfileController@updateCertification');
	Route::delete('employee/delete-certification/{id}', 'ProfileController@deleteCertification');

	Route::post('get-cv-by-search', 'CvManageController@getCvBySearch');

	Route::post('employee/update-employee-history', 'ProfileController@updateEmpHistory');
	Route::delete('employee/delete-employee-history/{id}', 'ProfileController@deleteEmpHistory');

	Route::get('employee/job-search/get-initial-data', 'JobSearchController@getInitialData');
	Route::post('employee/job-search/get-jobs', 'JobSearchController@getJobListBySearch');
	Route::post('employee/job-search/save-job', 'JobSearchController@savedJob');
	Route::resource('employee/job-search', 'JobSearchController');

	Route::get('employee/get-job-alert', 'JobsForController@getjobAlert');
	Route::get('employee/get-applied-jobs', 'JobsForController@getAppliedJobs');
	Route::get('employee/get-saved-jobs', 'JobsForController@getSavedJobs');
	Route::post('employee/saved-job/applied', 'JobsForController@savedJobApplied');
	Route::get('employee/get-local-waliking/jobs', 'JobsForController@getLocalWalkingJobs');
	Route::get('employee/get-inter-waliking/jobs', 'JobsForController@getInternationalWalkingJobs');
	Route::post('employee/store-slot-booking', 'JobsForController@storeSlot');

	Route::get('employee/get-application/status', 'JobsForController@getApplicationStatus');
	Route::resource('mail', 'MailController');

	Route::get('employer/application-received', 'JobsForController@getApplicationReceived');
	Route::get('application-status', 'JobsForController@getAllApplicationPhase');
	Route::get('employer/application-job/{id}', 'JobsForController@getApplicationJobById');
	Route::PUT('employer/applied-job-update/{id}', 'JobsForController@updateAppliedJob');

/*	Route::get('employer/cv-view-or-download-package','CvManageController@getCvViewPackage');*/
	Route::get('employer/package-list', 'PackageManageController@getPackageList');
	Route::get('package-details/{id}', 'PackageManageController@getPackageById');
	Route::post('payment', 'PackageManageController@payment');

	Route::resource('referal', 'ReferalController');

	Route::resource('custom-service', 'CustomServiceController');

});
