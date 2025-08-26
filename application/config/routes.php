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
$route['default_controller'] = 'Auth/Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/login'] = 'Auth/Auth/login';
$route['admin/logout'] = 'Auth/Auth/logout';
$route['admin/dashboard'] = 'Auth/Auth/dashboard';

$route['admin/products'] = 'Auth/Product/index';
$route['admin/products/create'] = 'Auth/Product/create';
$route['admin/products/edit/(:num)'] = 'Auth/Product/edit/$1';
$route['admin/products/delete/(:num)'] = 'Auth/Product/delete/$1';
$route['admin/products/view/(:num)'] = 'Auth/Product/view/$1';
$route['admin/products/delete_image/(:num)/(:num)'] = 'Auth/Product/delete_image/$1/$2';

$route['admin/cart']= 'Auth/Cart/index';
$route['admin/cart/order']= 'Auth/Cart/order';



// API routes
$route['api/products']['GET'] = 'api/products/index';
$route['api/products']['POST'] = 'api/products/create';
$route['api/products/(:num)']['GET'] = 'api/products/show/$1';
$route['api/products/(:num)']['PUT'] = 'api/products/update/$1';
$route['api/products/(:num)']['DELETE'] = 'api/products/delete/$1';
$route['api/products/(:num)/images/(:num)']['DELETE'] = 'api/products/delete_image/$1/$2';


$route['api/cart']['GET'] = 'api/cart/index';   
$route['api/cart/add']['POST'] = 'api/cart/add';
$route['api/cart/update']['POST'] = 'api/cart/update';
$route['api/cart/delete/(:num)']['DELETE'] = 'api/cart/delete/$1';
$route['api/cart/list']['GET'] = 'api/cart/list';
$route['api/cart/checkout'] = 'api/cart/checkout';

$route['api/cart/order']['GET'] = 'api/cart/order'; 



