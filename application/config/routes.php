<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
/**
 * 购物
 */
$route['shopping'] = "cshopping";
$route['shopping/product'] = "cshopping/product";
$route['shopping/cart'] = "cshopping/cart";

/**
 * 用户中心
 */
$route['uc'] = "cuc";
$route['uc/register'] = "cuc/register";
$route['uc/purchaser_orders'] = "cuc/purchaser_orders";
$route['uc/seller_orders'] = "cuc/seller_orders";
$route['uc/order'] = "cuc/order";
$route['uc/user'] = "cuc/user";
$route['uc/products'] = "cuc/products";
$route['uc/publish'] = "cuc/publish";
$route['uc/info'] = "cuc/info";
$route['uc/messages'] = "cuc/messages";

/**
 * 团队信息
 */
$route['info'] = "cinfo";
$route['info/about'] = "cinfo/about";
/**
 * 后台管理
 */
$route['admin'] = "cadmin/login";
$route['admin/login'] = "cadmin/login";
$route['admin/index'] = "cadmin/index";
$route['admin/users'] = "cadmin/users";
$route['admin/cats'] = "cadmin/cats";
$route['admin/addCat'] = "cadmin/addCat";
 
$route['default_controller'] = "home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */