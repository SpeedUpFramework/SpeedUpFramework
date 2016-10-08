<?php
namespace Core;
use Services\Session;
class Controller{

  public function __construct(){

    $loader = new \Twig_Loader_Filesystem('Application/Views');
    $this->twig = new \Twig_Environment($loader, array(
    'debug' => true,
    // ...
));

    $this->twig->addExtension(new \Twig_Extension_Debug());
    $this->twig->addGlobal('theme', TEMPLATE);
    $this->twig->addGlobal('site', DIR);

     if(Session::get('logged')){
         $this->twig->addGlobal('Username', Session::get("Username"));
     }
  }

}
