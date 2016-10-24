<?php
namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Services\Session;
class Config{

  public function __construct(){

    define('DIR', "http://localhost/Speedup/");
    define('APPDIR', $_SERVER['DOCUMENT_ROOT'].DIR.'Application/');
    define('TEMPLATE', DIR.'Templates/Default/');
    define('ASSETS', $_SERVER['DOCUMENT_ROOT']."/Speedup/Templates/Default/");

    Session::init();
    $capsule = new Capsule;

    $capsule->addConnection(array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'Speedup',
        'username'  => 'root',
        'password'  => 'root',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => ''
    ));

    $capsule->setEventDispatcher(new Dispatcher(new Container));

    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();

    new Router();


  }

}
