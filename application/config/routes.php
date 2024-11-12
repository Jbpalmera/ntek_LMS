<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'User_controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'Hello/index';

$route['admin'] = 'auth/index'; 
$route['signup'] = 'auth/signup';
$route['signin'] = 'auth/userlogin';
$route['dashboard'] = 'admin/dashboard';

$route['login'] = 'User_controller/index';

$route['dash'] = 'admin/dashboard';

$route['attendance'] = 'admin/attendance';

$route['fetch'] = 'admin/fetchData';

$route['category'] = 'Category_controller/add_category';
$route['manage'] = 'Category_controller/manage_categories';

$route['author'] = 'Author_controller/add_author';
$route['manageAuthor'] = 'Author_controller/manage_author';

$route['book'] = 'Book_controller/add_book';
$route['manageBook'] = 'Book_controller/manage_book';

$route['issueBook'] = 'BookDetails_controller/issue_book';
$route['manageIssuedBook'] = 'BookDetails_controller/manage_issued_books';

$route['registerStudent'] = 'Student_controller/register_student';
$route['membership'] = 'Membership_controller/index';
$route['studentList'] = 'Student_controller/student_list';

$route['thisDay'] = 'Report_controller/index';
$route['thisMonth'] = 'Report_controller/monthlyReport';

$route['changePassword'] = 'Admin/change_password';


// USER SIDE
$route['userLogin'] = 'User_controller/index';
$route['userSignup'] = 'User_controller/signUp';
$route['forgotPass'] = 'User_controller/forgotPass';

$route['userDash'] = 'User_controller/userDashboard';
$route['userBook'] = 'User_controller/books';
$route['userIssuedBook'] = 'UserProcess_controller/issuedBooks';

$route['userProfile'] = 'User_controller/profile';
$route['userChangePass'] = 'User_controller/changePass';

$route['checkOut'] = 'UserProcess_controller/index';
$route['nfcScan'] = 'UserProcess_controller/nfcScan';
$route['returnBook'] = 'UserProcess_controller/returnBook';

// KIOSK
$route['area'] = 'Area_controller/index';
$route['manageArea'] = 'Area_controller/manage_area';

// KIOSK API FOR NEW SETUP
$route['api/getStudentInfo'] = 'Kiosk/getStudentInfo';

// NFC
$route['api/nfc'] = 'Nfc/index';
$route['nfc/display'] = 'nfc/display';

// API for Bookdrop Kiosk
$route['api/getBorrowedBooks'] = 'Bookdrop_controller/getBorrowedBooks';
$route['api/bookReturn'] = 'Bookdrop_controller/bookReturn';

// BOOKENROLLMENT
$route['BookEnrollment'] = 'Enrollment_controller/index';
$route['BookPadReader'] = 'Enrollment_controller/bookPadReader';