<?php
use Illuminate\Routing\Router;

/** @var $router Router */

$router->get('', 'Controllers\WelcomeController@index');
$router->get('Documentation', 'Controllers\DocumentationController@index');
$router->get('Documentation/{slug}', 'Controllers\DocumentationController@getPage');
$router->any('Login', 'Controllers\WelcomeController@login');
$router->any('Admin', 'Controllers\AdminController@index');
$router->any('Admin/Categ-doc', 'Controllers\AdminController@categ');
$router->any('Admin/doc/add-doc', 'Controllers\AdminController@adddoc');
$router->any('Admin/doc', 'Controllers\AdminController@docs');
$router->any('Admin/doc/liste-doc', 'Controllers\AdminController@listeDoc');
$router->post('Ajax', 'Controllers\AjaxController@AdminAjax');
$router->get('logout', function (){
    \Services\Session::destroy("logged");
    \Services\Session::destroy("Username");
    \Services\Url::redirect("");
});

/** Fin routes */
