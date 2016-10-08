<?php
if(!file_exists('vendor/autoload.php')){
  die('Veuillez installer composer');
} else {
  require 'vendor/autoload.php';
}


if(!file_exists('Application/Core/Config.php')){
  die('Veuillez vérifier votre configuration');
} else {

  new Core\Config();


}
