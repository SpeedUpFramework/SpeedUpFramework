<?php


namespace Controllers;
use Core\Controller;
use Services\Encrypt;
use Services\Session;
use Models\AccountModel;
Class WelcomeController extends Controller{
  public function __construct(){
        parent::__construct();
    $this->encrypt = new Encrypt();
    $this->model_account = new AccountModel();

  }
  public function index(){

      //variable pour les liens
    $data['link'] = "home";

     // chargement de la vue
    echo $this->twig->render('Front/index.html.twig', $data);

  }

  
}
