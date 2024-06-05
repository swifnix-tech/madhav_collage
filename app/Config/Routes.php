<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){
    //set here for 404 override;
});
$routes->setAutoRoute(false);

// login routes here ;

$routes->match(['GET', 'POST'], 'login', 'Auth::index', ['filter' => 'noauth']);
$routes->post('login_porcess', 'Auth::get_login', ['filter' => 'noauth']);
$routes->get('/logout', 'Auth::logout');


// admin main route 
$routes->group("admin",["filter" => "auth"] , function($routes){
    // dashboard url
    $routes->get('/', 'admin\Home::index',["filter" => "auth"]); 
    
    // User Controllers
    $routes->get( 'users', 'admin\User::index',["filter" => "auth"]);
    $routes->post( 'save_user', 'admin\User::save_user',["filter" => "auth"]);
    $routes->get( 'user_table', 'admin\User::User_table',["filter" => "auth"]);
    $routes->get( 'edit_user/(:num)', 'admin\User::edit_user/$1',["filter" => "auth"]);
    $routes->get( 'blockuser', 'admin\User::block_user',["filter" => "auth"]);
    $routes->post( 'edit_save/(:num)', 'admin\User::edit_save/$1',["filter" => "auth"]);
    

    // degree 
    $routes->get("degree",'admin\Degree::index',["filter" => "auth"]);
    $routes->post("save_degree",'admin\Degree::saveing_degree',["filter" => "auth"]);

});

// accountant main route 
$routes->group("accountant",["filter" => "auth"] , function($routes){
   
});
// student main route 
$routes->group("student",["filter" => "auth"] , function($routes){
    
});

