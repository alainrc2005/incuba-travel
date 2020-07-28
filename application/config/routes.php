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
$route['default_controller'] = 'frontend/Home/Home';
$route['404_override'] = 'front/Home/Home';
$route['translate_uri_dashes'] = FALSE;

$route['Home'] = 'frontend/Home/Home';
$route['Policies'] = 'frontend/Home/Policies';
$route['ContactUs'] = 'frontend/Home/ContactUs';
$route['AboutUs'] = 'frontend/Home/AboutUs';
$route['Hotels'] = 'frontend/Home/Hotels';
$route['Packs'] = 'frontend/Home/Packs';
$route['Roundtrips'] = 'frontend/Home/Roundtrips';
$route['Excursions'] = 'frontend/Home/Excursions';
$route['Cars'] = 'frontend/Home/Cars';
$route['Events'] = 'frontend/Home/Events';
$route['GenCaptcha'] = 'frontend/Api/captcha';
$route['sendContact'] = 'frontend/Home/sendContact';
$route['CartHotel/(:num)'] = 'frontend/Home/CartHotel/$1';
$route['CartPack/(:num)'] = 'frontend/Home/CartPack/$1';
$route['CartRoundtrip/(:num)'] = 'frontend/Home/CartRoundtrip/$1';
$route['CartExcursion/(:num)'] = 'frontend/Home/CartExcursion/$1';
$route['CartCar/(:num)'] = 'frontend/Home/CartCar/$1';
$route['CartEvent/(:num)'] = 'frontend/Home/CartEvent/$1';
$route['Api/(:any)'] = 'frontend/Api/$1';
$route['Lang'] = 'frontend/Home/Lang';
$route['Checkout'] = 'frontend/Home/Checkout';
$route['Confirm'] = 'frontend/Home/confirmPayment';
$route['PaymentSuccess/(:any)'] = 'frontend/Home/PaymentSuccess/$1';
$route['SuccessUrl/(:any)'] = 'frontend/Api/PaymentSuccess/$1';
$route['ErrorUrl/(:any)'] = 'frontend/Api/PaymentError/$1';
$route['Vouchers/(:any)'] = 'frontend/Home/vouchersGenerator/$1';
$route['Viewer/(:any)'] = 'frontend/Home/vouchersViewer/$1';
$route['RequestCar'] = 'frontend/Home/requestCar';
$route['CarConfirmation/(:any)'] = 'frontend/Home/CarConfirmation/$1';
$route['ManualConfirmation/(:any)'] = 'frontend/Home/ManualConfirmation/$1';
$route['Currency/(:any)'] = 'frontend/Home/Currency/$1';
$route['Currencies/(:any)'] = 'frontend/Home/Currencies/$1';
