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
$route['default_controller'] = 'home';
$route['404_override'] = 'error404';
$route['translate_uri_dashes'] = FALSE;


//GROUPE
$route['gestion-groupe'] 				= 'groupe/groupe';
$route['ajouter-un-groupe'] 			= 'groupe/groupe/ajouter';
$route['gestion-groupe-edit/(:any)'] 	= 'groupe/groupe/view/$1';
$route['groupe_param/(:any)'] 			= 'groupe/groupe/$1';
$route['groupe_supp/(:any)'] 			= 'groupe/groupe/supprimer_groupe/$1';

//LOGIN
$route['login'] 				= 'gestion_login/login';
$route['mot-de-passe-oublie'] 	= 'gestion_login/login/reset_mot_de_passe';
$route['login_param/(:any)'] 	= 'gestion_login/login/$1';

//EXPORT
$route['manifeste'] 				= 'export/export';
$route['manifeste_supp/(:any)'] 			= 'export/export/supprimer_manifeste/$1';
$route['modifier_un_manifeste/(:any)'] 				= 'export/export/modifier_un_manifeste/$1';
$route['reservation'] 				= 'export/export/recherche_reservation/e/reservation';
$route['reservation.pdf'] 				= 'export/export/reservationpdf';
$route['reservation_supp/(:any)'] 			= 'export/export/supprimer_reservation/$1';
$route['warehouse'] 				= 'export/export/antrepot/e/warehouse';
$route['warehouse_supp/(:any)'] 			= 'export/export/supprimer_warehouse/$1';
$route['modifier_warehouse/(:any)'] 				= 'export/export/modifier_antrepot/e/warehouse/$1';
$route['Airway_Bill'] 				= 'export/export/Airway_Bill/e/Airway_Bill';
$route['creer-awb'] 				= 'export/export/add_Airway_Bill/e/Airway_Bill';
$route['creer-une-reservation'] 				= 'export/export/add_reservation/e/reservation';
$route['modifier-une-reservation/(:any)'] 				= 'export/export/modifier_reservation/$1';
$route['creer-warehouse'] 				= 'export/export/add_antrepot/e/warehouse';
$route['lister_awb'] 				= 'export/export/liste_awb/e/ajouter';
$route['lister_awb_vol'] 				= 'export/export/liste_awb_vol/e/recherche';
$route['creer-un-manifeste'] 				= 'export/export/ajouter_un_manifeste/e/ajouter';
$route['recherche_un_manifeste'] 				= 'export/export/rech_manifeste/e/recherche';
//
