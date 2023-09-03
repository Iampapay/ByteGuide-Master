<?php

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\TrainingCentreController;
use App\Http\Controllers\Admin\AdminPlacementController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\AdminBatchController;
use App\Http\Controllers\Admin\ImportUserController;
use App\Http\Controllers\centre\DashboardController;
use App\Http\Controllers\centre\LoginController;
use App\Http\Controllers\centre\CentreLoginController;
use App\Http\Controllers\centre\CentreStudentController;
use App\Http\Controllers\centre\CentrePlacementController;
use App\Http\Controllers\centre\CentreBatchController;
use App\Http\Controllers\centre\CentreCourseController;
use App\Http\Controllers\centre\StudentController;
use App\Http\Controllers\centre\BatchController;
use App\Http\Controllers\centre\PlacementController;

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

Route::get('/optimize-clear', function () {
	$a = Artisan::call('optimize:clear');
	$a = Artisan::call('cache:clear');
	$a = Artisan::call('config:clear');
});

Route::get('composer-update', function () {
	exec('composer update');
});

Route::get('/', function () {
	return view('welcome');
});

// <================ admin login start ============> //
Route::get('/login', 'Admin\AuthController@showLogin')->name('admin.login');
Route::post('/login', 'Admin\AuthController@storeLogin');
Route::get('/reload-captcha', 'Admin\AuthController@reloadCaptcha');

Route::group(['namespace' => 'Admin', 'prefix' => '/admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
	Route::get('/logout', 'AuthController@logout')->name('logout');
	Route::get('/', 'DashboardController@index')->name('dashboard');

	Route::get('/user-manage', 'UserManageController@index')->name('user-manage.index')->middleware('admin.roles:user-list');
	Route::get('/user-manage/create', 'UserManageController@create')->name('user-manage.create')->middleware('admin.roles:user-create');
	Route::post('/user-manage/create', 'UserManageController@store')->name('user-manage.store')->middleware('admin.roles:user-create');
	Route::get('/user-manage/{id}', 'UserManageController@edit')->name('user-manage.edit')->middleware('admin.roles:user-edit');
	Route::put('/user-manage/{id}', 'UserManageController@update')->name('user-manage.update')->middleware('admin.roles:user-edit');
	Route::delete('/user-manage/{id}', 'UserManageController@destroy')->name('user-manage.delete')->middleware('admin.roles:user-delete');

	Route::get('/role', 'RoleController@index')->name('role.index');
	Route::get('/role/create', 'RoleController@create')->name('role.create');
	Route::post('/role', 'RoleController@store')->name('role.store');
	Route::get('/role/{id}', 'RoleController@edit')->name('role.edit');
	Route::put('/role/{id}', 'RoleController@update')->name('role.update');
	Route::delete('/role/{id}', 'RoleController@destroy')->name('role.delete');

	Route::get('/create-training-centre', [TrainingCentreController::class, 'createTrainingCentre'])->name('centre.create');
	Route::get('/center-list', [TrainingCentreController::class, 'centreList'])->name('centre.list');
    Route::post('/add-training-centre', [TrainingCentreController::class, 'addTrainingCentre'])->name('centre.add');

	Route::get('/view-trainee-list', [StudentsController::class, 'viewTraineeList'])->name('trainee.list');
	Route::get('/fetch-trainee-list', [StudentsController::class, 'fetchTraineeList'])->name('trainee.fetch');

	Route::get('/batch-approval', [AdminBatchController::class, 'batchApproval'])->name('batch.approval');
	Route::get('/search-batch-details', [AdminBatchController::class, 'searchBatchDetails'])->name('batch.details.search');
	Route::get('/view-batch-details/{id}', [AdminBatchController::class, 'viewBatchDetails'])->name('batch.view.details');
	Route::post('/batch-monitoring-list', [AdminBatchController::class, 'batchMonitoringList'])->name('batch.monitoring.list');
	Route::post('/permission-request', [AdminBatchController::class, 'batchPermissionReq'])->name('batch.permission');

	Route::get('/batch-slot', [AdminBatchController::class, 'viewSlot'])->name('slot.view');
	Route::post('/add-slot', [AdminBatchController::class, 'addSlot'])->name('slot.add');
	Route::get('/fetch-slot', [AdminBatchController::class, 'fetchBatchSlot'])->name('slot.fetch');
	Route::post('/edit-slot', [AdminBatchController::class, 'editBatchSlot'])->name('slot.edit');
	Route::post('/update-slot', [AdminBatchController::class, 'updateBatchSlot'])->name('slot.update');
	Route::post('/delete-slot', [AdminBatchController::class, 'deleteBatchSlot'])->name('slot.delete');

	Route::get('/employeer', [AdminPlacementController::class, 'viewEmployeer'])->name('employeer.view');
	Route::post('/add-employeer', [AdminPlacementController::class, 'addEmployeer'])->name('employeer.add');
	Route::get('/fetch-employeer', [AdminPlacementController::class, 'fetchEmployeer'])->name('employeer.fetch');
	Route::post('/edit-employeer', [AdminPlacementController::class, 'editEmployeer'])->name('employeer.edit');
	Route::post('/update-employeer', [AdminPlacementController::class, 'updateEmployeer'])->name('employeer.update');
	Route::post('/delete-employeer', [AdminPlacementController::class, 'deleteEmployeer'])->name('employeer.delete');

	Route::get('/placement', [AdminPlacementController::class, 'viewPlacement'])->name('placement.view');
	Route::post('/add-placement', [AdminPlacementController::class, 'addPlacement'])->name('placement.add');
	Route::get('/fetch-placement', [AdminPlacementController::class, 'fetchPlacement'])->name('placement.fetch');
	Route::post('/edit-placement', [AdminPlacementController::class, 'editPlacement'])->name('placement.edit');
	Route::post('/update-placement', [AdminPlacementController::class, 'updatePlacement'])->name('placement.update');
	Route::post('/delete-placement', [AdminPlacementController::class, 'deletePlacement'])->name('placement.delete');
	Route::get('/trainee-placement/{id}', [AdminPlacementController::class, 'traineePlacement'])->name('placement.trainee');
	Route::get('/search-batch', [AdminPlacementController::class, 'searchBatch'])->name('batch.search');
	Route::get('/batch/{id}', [AdminPlacementController::class, 'viewBatch'])->name('batch.view');
    Route::get('/assessed-trainee-list', [AdminPlacementController::class, 'assessedTraineeList'])->name('batch.assessed-list');
	Route::get('/trainee-placement-details/{id}', [AdminPlacementController::class, 'traineePlacementDetails'])->name('placement.traineePlacementDetails');
    Route::get('/interested-student', [AdminPlacementController::class, 'viewInterestedStudent'])->name('student.interested');
	Route::get('/fetch-interested-student', [AdminPlacementController::class, 'fetchInterestedStudent'])->name('fetch.interestedStudent');
	Route::get('/import-student', [ImportUserController::class, 'import_user'])->name('import_student.view');
	Route::post('/import-student-details', [ImportUserController::class, 'importData'])->name('import_student.details');
});

// <================ centre login start ============> //
Route::get('/centre-login', 'centre\CentreLoginController@showCentreLogin')->name('centre.login');
Route::post('/centre-login', 'centre\CentreLoginController@storeCentreLogin');

Route::group(['namespace' => 'centre', 'prefix' => '/centre', 'as' => 'centre.', 'middleware' => 'centre'], function () {
    Route::get('/logout', 'CentreLoginController@logout')->name('logout');
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('/student', [CentreStudentController::class, 'viewReg'])->name('student.view');
	Route::post('/add-student', [CentreStudentController::class, 'addStudent'])->name('student.add');
	Route::get('/view-student-list', [CentreStudentController::class, 'viewStudent'])->name('student.list-view');
	Route::get('/fetch-register-student', [CentreStudentController::class, 'fetchRegStudent']);

	Route::get('/placement', [CentrePlacementController::class, 'viewPlacement'])->name('placement.view');
	Route::get('/fetch-placement', [CentrePlacementController::class, 'fetchPlacementDetails']);
	Route::get('/show-placement-details/{id}', [CentrePlacementController::class, 'showPlacementDetails'])->name('showStudent.list');
	Route::get('/fetch-student-under-batch', [CentrePlacementController::class, 'fetchStudentUnderBatch']);
	Route::get('/fetch-student-assign-batch', [CentrePlacementController::class, 'fetchStudentToAssignBatch'])->name('student.fetch');
	Route::post('/send-whatsapp-msg', [CentrePlacementController::class, 'sendMessage']);

	Route::get('/centre-fetch-batch-details', [CentreBatchController::class, 'fetchBatchDetailsCentre'])->name('batch.list');
	Route::get('/centre-fetch-batch', [CentreBatchController::class, 'fetchBatch'])->name('batch.fetch');
	Route::post('/centre-add-batch', [CentreBatchController::class, 'addBatch'])->name('batch.add');
	Route::post('/centre-edit-batch', [CentreBatchController::class, 'editBatch'])->name('batch.edit');
	Route::post('/centre-update-batch', [CentreBatchController::class, 'updateBatch'])->name('batch.update');
	Route::post('/centre-delete-batch', [CentreBatchController::class, 'deleteBatch'])->name('batch.delete');
	Route::post('/batch-app-req', [CentreBatchController::class, 'approveBatch'])->name('batch.approve');
	Route::get('/show-student-list/{id}', [CentreBatchController::class, 'studentList'])->name('student.list');
	Route::get('/fetch-batch-data', [CentreBatchController::class, 'fetchBatchData'])->name('batch.data');
	Route::post('/assign-batch', [CentreBatchController::class, 'assignBatch'])->name('batch.assign');


	Route::get('/centre-fetch-course-details', [CentreCourseController::class, 'fetchCourseDetailsCentre'])->name('course.list');
	Route::get('/centre-fetch-course', [CentreCourseController::class, 'fetchCourse'])->name('Course.fetch');
	Route::post('/centre-add-course', [CentreCourseController::class, 'addCourse'])->name('Course.add');
	Route::post('/centre-edit-course', [CentreCourseController::class, 'editCourse'])->name('Course.edit');
	Route::post('/centre-update-course', [CentreCourseController::class, 'updateCourse'])->name('Course.update');
	Route::post('/centre-delete-course', [CentreCourseController::class, 'deleteCourse'])->name('Course.delete');
});

Route::get('/student-feedback-form/{id}', [CentrePlacementController::class, 'studentFeedback']);
Route::post('/submit-placement-feedback', [CentrePlacementController::class, 'submitPlacementFeedback'])->name('placement-submit');

Route::post('/api/fetch_dist', [CentreStudentController::class, 'fetch_dist']);
Route::post('/api/fetch_block', [CentreStudentController::class, 'fetch_block']);
