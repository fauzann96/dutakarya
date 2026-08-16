<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


//harap tata sesuai controller
//$routes->get('/', 'Home::index');

$routes->get('/','Auth::login_page',['filter' => 'already_auth_filter']);
$routes->get('/akses_diblokir','ErrorController::viewRestricted');

$routes->get('/login','Auth::login_page',['filter' => 'already_auth_filter']);
$routes->post('/login/submit','Auth::loginSubmit');

$routes->get('/korlap/login','AuthKorlapController::loginPage');
$routes->post('/korlap/login/submit','AuthKorlapController::loginSubmit');

$routes->get('/logout','Auth::logout');

$routes->get('/layout','Layout');
$routes->post('/layout/setSidebar','Layout::setSidebar');

$routes->group('korlap', ['filter' => 'korlap_filter'], function($routes) {
	$routes->get('attendance/input','AttendanceControllerKorlap::input');
	$routes->post('attendance/check_if_exist','AttendanceControllerKorlap::checkifexist');
	$routes->post('attendance/input/form_data','AttendanceControllerKorlap::formData');
	$routes->post('attendance/input/submit','AttendanceControllerKorlap::inputSubmit');
	$routes->get('attendance/data','AttendanceControllerKorlap::dataView');
	$routes->post('attendance/data/fetch','AttendanceControllerKorlap::fetch');
	$routes->get('attendance/data/generate/excel/(:segment)/(:segment)','AttendanceControllerKorlap::generateExcel/$1/$2');
	$routes->get('attendance/data/generate/pdf/(:segment)/(:segment)','AttendanceControllerKorlap::generatePdf/$1/$2');

	$routes->get('employee','EmployeeControllerKorlap::index');
	$routes->post('employee/datatable','EmployeeControllerKorlap::dataTable');
	$routes->get('employee/(:num)','EmployeeControllerKorlap::view/$1');//terpakai
	$routes->get('employee/attendance/(:num)','EmployeeControllerKorlap::view/$1');

	$routes->get('assignment/backup','BackupAssignmentControllerKorlap::index');//tepakai
	$routes->post('assignment/backup/datatable','BackupAssignmentControllerKorlap::dataTable');//terpakai

});

$routes->group('', ['filter' => 'admin_filter'], function($routes) {
	$routes->get('/customer','CustomerController::index');
	$routes->post('/customer/datatable','CustomerController::dataTable');
	$routes->get('/customer/(:num)','CustomerController::view/$1');
	$routes->post('/customer/data','CustomerController::data');
	$routes->post('/customer/option','CustomerController::option');
	$routes->post('/customer/delete/submit','CustomerController::deleteSubmit');
	$routes->post('/customer/edit/submit','CustomerController::editSubmit');
	$routes->post('/customer/korlap/option','CustomerController::korlapOption');
	$routes->post('/customer/korlap/submit','CustomerController::korlapSubmit');

	$routes->post('/customer/location/option','CustomerController::locationOption');

	$routes->post('/customer/employee/datatable','CustomerController::dataTableEmployee');
	$routes->post('/customer/location/datatable','CustomerController::dataTableLocation');
	$routes->post('/customer/location/delete/submit','CustomerController::locationDeleteSumbit');
	$routes->post('/customer/location/new/submit','CustomerController::locationNewSubmit');
	$routes->post('/customer/location/edit/submit','CustomerController::locationEditSubmit');
	$routes->post('/customer/new/submit','CustomerController::newSubmit');
	
	$routes->get('/organization','OrganizationController::index');
	$routes->post('/organization/data','OrganizationController::data');
	$routes->post('/organization/edit/submit','OrganizationController::editSubmit');
	$routes->get('/organization/division','OrganizationController::division');
	$routes->post('/organization/division/data','OrganizationController::dataDivision');
	$routes->post('/organization/division/edit/submit','OrganizationController::editSubmitDivision');
	$routes->post('/organization/division/new/submit','OrganizationController::newSubmitDivision');
	$routes->post('/organization/division/delete/submit','OrganizationController::deleteSubmitDivision');
	$routes->post('/organization/division/datatable','OrganizationController::datatableDivision');

	$routes->get('/position','PositionController::index');
	$routes->post('/position/datatable','PositionController::dataTable');
	$routes->post('/position/option','PositionController::option');
	$routes->post('/position/new/submit','PositionController::newSubmit');
	$routes->post('/position/delete/submit','PositionController::deleteSubmit');
	$routes->post('/position/edit/submit','PositionController::editSubmit');

	$routes->get('/area','AreaController');
	$routes->post('/area/option','AreaController::option');
	$routes->post('/customer/area/datatable','AreaController::datatable');
	$routes->post('/customer/area/delete','AreaController::delete');
	$routes->get('/area/datatable','AreaController::dataTable');//terpakai
	$routes->post('/area/customer/datatable','AreaController::customerDataTable');//terpakai
	$routes->get('/area/data/(:num)','AreaController::data/$1');//terpakai
	$routes->post('/area/new/submit','AreaController::newSubmit');//terpakai
	$routes->post('/area/edit/submit','AreaController::editSubmit');//terpakai

	$routes->get('/calendar_manager','CalendarManagerController::index');
	$routes->post('/api/calendar_manager/delete','ApiCalendarManager::delete');
	$routes->post('/api/calendar_manager/update','ApiCalendarManager::update');
	$routes->post('/calendar_manager/new/submit','CalendarManagerController::newSubmit');
	$routes->post('/api/calendar_manager/datatable','ApiCalendarManager::dataTable');
	$routes->get('/api/calendar_manager/data/(:num)','ApiCalendarManager::data/$1');
	$routes->get('/api/do-type/options','ApiCalendarManager::doTypeOptions');

	$routes->get('candidate','CandidateController');// terpakai
	$routes->post('/candidate/datatable','CandidateController::dataTable'); //terpakai
	$routes->post('/candidate/option','CandidateController::option'); //terpakai
	$routes->post('/candidate/new/submit','CandidateController::newSubmit'); //terpakai
	$routes->post('/candidate/edit/submit','CandidateController::editSubmit'); //terpakai
	$routes->post('/candidate/change_ktp/submit','CandidateController::changeKtpSubmit'); //terpakai
	$routes->post('/candidate/change_pas_foto/submit','CandidateController::changePasFotoSubmit'); //terpakai
	$routes->post('/candidate/change_sim/submit','CandidateController::changeSimSubmit'); //terpakai
	$routes->post('/candidate/delete/submit','CandidateController::deleteSubmit');// terpakai
	$routes->get('/candidate/(:num)','CandidateController::view/$1');// terpakai
	$routes->post('/candidate/data','CandidateController::data');//terpakai buat edit

	$routes->get('/candidate/accepted','CandidateController::indexAccepted');// terpakai

	$routes->get('/payslip','PayslipController');//terpakai
	$routes->post('/payslip/datatable','PayslipController::datatable');
	$routes->post('/payslip/data','PayslipController::data');//terpakai
	$routes->post('/payslip/checkifexist','PayslipController::checkIfExist');//terpakai
	$routes->post('/payslip/new/submit','PayslipController::newSubmit');//terpakai
	$routes->post('/payslip/edit/submit','PayslipController::editSubmit');//terpakai
	$routes->post('/payslip/delete/submit','PayslipController::deleteSubmit');//terpakai
	$routes->post('/payslip/send_email','PayslipController::sendEmailre');//terpakai
	$routes->get('/payslip/email','PayslipController::sendEmail');//terpakai
	$routes->get('/payslip/(:num)','PayslipController::view/$1');//terpakai
	$routes->get('/payslip/edit/(:num)','PayslipController::edit/$1');
	$routes->get('/payslip/download/pdf/(:num)','PayslipController::downloadPdf/$1');//terpakai
	$routes->get('/payslip/employee/new/(:num)/(:segment)','PayslipController::viewInputForm/$1/$2');//terpakai

	$routes->get('employee','EmployeeController');//terpakai
	$routes->post('employee/datatable','EmployeeController::dataTable'); //ok
	$routes->post('employee/data','EmployeeController::data'); //ok
	$routes->post('employee/new/submit','EmployeeController::newSubmit'); //ok
	$routes->post('employee/edit/submit','EmployeeController::editSubmit'); //ok
	$routes->post('employee/change_ktp/submit','EmployeeController::changeKtpSubmit'); //terpakai
	$routes->post('employee/change_pas_foto/submit','EmployeeController::changePasFotoSubmit'); //terpakai
	$routes->post('employee/change_sim/submit','EmployeeController::changeSimSubmit'); //terpakai
	$routes->get('employee/editdata','EmployeeController::editData');//terpakai
	$routes->get('employee/(:num)','EmployeeController::view/$1');//terpakai
	$routes->get('employee/resigned','EmployeeController::indexResigned');//terpakai
	$routes->post('employee/delete/submit','EmployeeController::deleteSubmit'); //ok
	$routes->post('employee/cancel_resign/submit','EmployeeController::cancelResignSubmit'); //ok
	$routes->post('employee/check_nip','EmployeeController::checkNip'); //ok

	$routes->post('employee/import/preview','EmployeeController::importPreview');//terpakai

	$routes->get('/assignment/backup','BackupAssignmentController::index');//tepakai
	$routes->post('/assignment/backup/datatable','BackupAssignmentController::dataTable');//terpakai
	$routes->post('/assignment/backup/checkifexist','BackupAssignmentController::checkIfExist');//terpakai
	$routes->post('/assignment/backup/data','BackupAssignmentController::data');//terpakai
	$routes->post('/assignment/backup/new/submit','BackupAssignmentController::newSubmit');//terpakai
	$routes->post('/assignment/backup/edit/submit','BackupAssignmentController::editSubmit');//terpakai
	$routes->post('/assignment/backup/delete/submit','BackupAssignmentController::deleteSubmit');//terpakai

	$routes->get('working_unit','WorkingUnitController');//terpakai
	$routes->get('working_unit/(:num)','WorkingUnitController::view/$1');//terpakai

	$routes->get('area','AreaController');
	$routes->get('area/(:num)','AreaController::view/$1');
	
	$routes->get('/slip','Slip::index');
	$routes->get('/slip/form','Slip::form_slip');

	$routes->get('/attendance/input','AttendanceController::input');
	$routes->post('/attendance/check_if_exist','AttendanceController::checkifexist');
	$routes->post('/attendance/input/form_data','AttendanceController::formData');
	$routes->post('/attendance/input/submit','AttendanceController::inputSubmit');
	$routes->get('/attendance/report/','AttendanceController::report');
	$routes->get('/attendance/data','AttendanceController::dataView');
	$routes->post('/attendance/data/fetch','AttendanceController::fetch');
	$routes->get('/attendance/data/generate/excel/(:num)/(:segment)/(:segment)','AttendanceController::generateExcel/$1/$2/$3');
	$routes->get('/attendance/data/generate/pdf/(:num)/(:segment)/(:segment)','AttendanceController::generatePdf/$1/$2/$3');
	$routes->get('attendance/report/pdf/(:num)/(:segment)/(:segment)','AttendanceExportController::reportPdf/$1/$2/$3');

	$routes->get('/fc_manager','FCController::index');
	$routes->post('/api/field-coordinator/datatable','ApiFieldCoordinator::dataTable');
	$routes->post('/fc_manager/reset_password','FCController::resetPassword');

	$routes->get('/user-setting','UserSettingController');
	$routes->post('/api/user-setting/change-password','ApiUserSetting::changePassword');//terpakai untuk ganti password
	$routes->post('/api/user-setting/update','ApiUserSetting::update');
	$routes->post('/api/user-setting/upload-signature','ApiUserSetting::uploadSignature');

	$routes->get('/lock','LockController');
	$routes->get('/lock/datatable','LockController::datatable');
	$routes->post('/lock/data','LockController::data');
	$routes->post('/lock/check_date','LockController::checkDate');
	$routes->post('/lock/new/submit','LockController::newSubmit');
	$routes->post('/lock/edit/submit','LockController::editSubmit');
});

$routes->group('', ['filter' => 'superadmin_filter'], function($routes) {
	$routes->get('/user_manager','UserManagerController::index');
	$routes->post('/api/user_manager/datatable','ApiUserManager::dataTable');
	$routes->post('/api/user_manager/change_status','ApiUserManager::changeStatus');
	$routes->post('/api/user_manager/reset_password','ApiUserManager::resetPassword');
	$routes->post('/api/user_manager/check_username','ApiUserManager::checkUsername');
	$routes->post('/api/user_manager/new/submit','ApiUserManager::newSubmit');
	$routes->post('/api/user_manager/edit/submit','ApiUserManager::editSubmit');
	$routes->get('/api/user_manager/user_data/(:num)','ApiUserManager::userData/$1');

	$routes->post('/user_manager/check_employee','UserManagerController::check_employee');

	$routes->get('/api/user-type/options','UserTypeController::option');
});

$routes->group('', ['filter' => 'jquery_filter'], function($routes) {
	
	$routes->post('/gender/option','GenderController::option');
	$routes->post('/marrital_status/option','MarritalStatusController::option');
	$routes->get('/option/dayofftype','JqueryOptionController::dayOffType');

	$routes->post('employee/checkNpk','EmployeeJqueryController::checkNpk');//terpakai
	$routes->post('employee/checkSpk','EmployeeJqueryController::checkSpk');//terpakai
	$routes->post('employee/mutation/submit','EmployeeController::mutationSubmit');//terpakai
	$routes->post('employee/spk_update/submit','EmployeeController::spkUpdateSubmit');//terpakai
	$routes->post('employee/resign/submit','EmployeeController::resignSubmit');//terpakai
	$routes->post('employee/data_edit/submit','EmployeeController::dataEditSubmit');//terpakai
	$routes->post('employee/family_edit/submit','EmployeeController::familyEditSubmit');//terpakai

	$routes->post('/customer/employee/option','CustomerController::employeeOption');
	
});


