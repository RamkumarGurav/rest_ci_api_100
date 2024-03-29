<?php
defined('BASEPATH') or exit ('No direct script access allowed');

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
$route['default_controller'] = 'AuthController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//{--------------ADMIN--------------
$route['login'] = 'AuthController/login';
$route['logout'] = 'AuthController/logout';
$route['admin'] = 'admin/DashboardController/index';
$route['admin/dashboard'] = 'admin/DashboardController/index';
$route['admin/financial-years/listing'] = 'admin/FinancialYearController/index';
$route['admin/financial-years/add'] = 'admin/FinancialYearController/add_get';
$route['admin/financial-years/update/(:num)'] = 'admin/FinancialYearController/update/$1';
$route['admin/albums/listing'] = 'admin/AlbumController/index';
$route['admin/gallery/listing'] = 'admin/GalleryController/index';
//--------------------------------------------------}

//{--------------public api --------------
$route['api/public/test'] = 'api/public/ApiDemoController/index';
$route['api/years']['GET'] = 'api/ApiFinancialYearController/findAllActive_get';
$route['api/years/(:num)']['GET'] = 'api/ApiFinancialYearController/findOneActive_get/$1';
$route['api/albums']['GET'] = 'api/ApiAlbumController/findAllActive_get';
$route['api/albums/(:num)']['GET'] = 'api/ApiAlbumController/findOneActive_get/$1';
$route['api/album-images']['GET'] = 'api/ApiGalleryController/findAllActive_get';
$route['api/album-images/(:num)']['GET'] = 'api/ApiGalleryController/findOneActive_get/$1';

// //{--------------public api useing REST_Controller--------------
// $route['api/test'] = 'api/ApiDemoController/index';
// $route['api/fy'] = 'api/ApiFinancialYear/getAllActive';
// $route['api/posts']['POST'] = 'api/ApiPostsController/createOne';
// $route['api/posts']['GET'] = 'api/ApiPostsController/getAll';
// $route['api/posts/(:num)']['GET'] = 'api/ApiPostsController/getOneById/$1';
// $route['api/posts/(:num)']['POST'] = 'api/ApiPostsController/updateOne/$1';
// $route['api/posts/(:num)']['DELETE'] = 'api/ApiPostsController/deleteOne/$1';