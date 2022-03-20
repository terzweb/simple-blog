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
|	https://codeigniter.com/user_guide/general/routing.html
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
# $route['default_controller'] = "login";
$route['default_controller'] = "Welcome";
#$route['404_override'] = 'errors';
$route['404_override'] = 'Myerror/error_404';

/*フロント・サイド*/
$route['post'] = "post";
$route['post/(:any)'] = "post/id/$1";

$route['tag'] = "tags";
$route['tag/(:any)'] = "tags/id/$1";


$route['contact'] = "contact";
$route['contact/validation'] = "contact/validation";

/*********** Admin route *******************/
$route[ADMINURL] = 'admin/login';
$route[ADMINURL.'/loginMe'] = 'admin/login/loginMe';
$route[ADMINURL.'/logout'] = 'admin/login/logout';

$route[ADMINURL.'/profile'] = 'admin/profile';
$route[ADMINURL.'/profile/editPost'] = 'admin/profile/editPost';

$route[ADMINURL.'/posts'] = 'admin/posts';
$route[ADMINURL.'/posts/postList'] = 'admin/posts/postList';
$route[ADMINURL.'/posts/postList/(:num)'] = 'admin/posts/postList/$1';
$route[ADMINURL.'/posts/addNew'] = 'admin/posts/addNew';
$route[ADMINURL.'/posts/addnewpost'] = 'admin/posts/addNewPost';
$route[ADMINURL.'/posts/editOld/(:num)'] = 'admin/posts/editOld/$1';
$route[ADMINURL.'/posts/editPost'] = 'admin/posts/editPost';
$route[ADMINURL.'/posts/deletePost'] = 'admin/posts/deletePost';

$route[ADMINURL.'/config'] = 'admin/config';
$route[ADMINURL.'/config/adding'] = 'admin/config/adding';
$route[ADMINURL.'/config/editupdate'] = 'admin/config/editupdate';


$route[ADMINURL.'/forgotPassword'] = 'admin/login/forgotPassword';
$route[ADMINURL.'/resetPassword'] = 'admin/login/resetPassword';
$route[ADMINURL.'/resetPasswordConfirmUser/(:any)/(:any)'] = 'admin/login/resetPasswordConfirmUser/$1/$2';
$route[ADMINURL.'/createPasswordUser'] = 'admin/login/createPasswordUser';


$route[ADMINURL.'/checkUrlExists'] = 'admin/posts/checkUrlExists';
