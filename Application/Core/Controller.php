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

    if(\Services\Assets::isLocal()){
      $this->twig->addGlobal('css', \Services\Assets::path("app.css"));
      $this->twig->addGlobal('js', \Services\Assets::path("app.js"));
    } else {
      $this->twig->addGlobal('css', TEMPLATE.\Services\Assets::path("app.css"));
      $this->twig->addGlobal('js', TEMPLATE.\Services\Assets::path("app.js"));
    }


     if(Session::get('logged')){

         $this->twig->addGlobal('Username', Session::get("Username"));
     }
  }

}
