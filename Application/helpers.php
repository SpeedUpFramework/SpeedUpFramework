<?php

function debug($var){
  echo '<pre>' . print_r($var, true) . '</pre>';
}
function generate_token($taille){

 $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
 $key = str_shuffle(str_repeat($alphabet, $taille));
 return substr($key, 0, $taille);

}
function logged_only(){
$session = new \Services\Session();
$url = new \Services\Url();
  if(!$session->get('logged')){

      $url->redirect('login');
  }
}
function create_slug($string){
    $slug= preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower($slug);
}
function findExtension ($filename)
{
   $filename = strtolower($filename) ;
   $exts = explode(".", $filename) ;
   $n = count($exts)-1;
   $exts = $exts[$n];
   return $exts;
}
