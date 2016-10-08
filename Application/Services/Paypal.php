<?php
namespace Services;
use \Widgets\Session;
class Paypal
{
  /* Initialisation de l'objet:
  * $objPaypal = new \Services\Paypal("utilisateur", "pass", "signature", 10.00, true);
  * $objPaypal->buy(); // Cela va permettre de lancer l'achat Paypal
  * Sur la page success:
  * $objPaypal = new \Services\Paypal("utilisateur", "pass", "signature", 10.00, true);
  * if($objPaypal->success()){
  * Faire le traitement sql 
  *      }; // Si le success = a true
  */
  public function __construct($username, $password, $signature, $amount, $sandbox = true){
    $this->Paypal = new \Omnipay\Common\GatewayFactory();
    $this->param = array(
              'cancelUrl' => 'http://labo.dev'.DIR.'CancelCommand',
              'returnUrl' => 'http://labo.dev'.DIR.'SuccessCommand',
              'description' => 'vente',
              'amount' => $amount,
              'currency' => 'EUR'
      );
    $this->Username = $username;
    $this->Sandbox  = $sandbox;
    $this->Password = $password;
    $this->Signature= $signature;
  }
  public function buy(){



         $gateway = $this->Paypal->create('PayPal_Express');
         $gateway->setUsername($this->Username);
         $gateway->setPassword($this->Password);
         $gateway->setSignature($this->Signature);
         $gateway->setTestMode($this->Sandbox);
         $response = $gateway->purchase($this->param)->send();
         if($response->isSuccessful()){
           print_r($response);
         } else if($response->isRedirect()){
           $response->redirect();
         } else {
           echo $response->getMessage();
         }
      }
      public function success()
      {
        $gateway = $this->Paypal->create('PayPal_Express');
        $gateway->setUsername($this->Username);
        $gateway->setPassword($this->Password);
        $gateway->setSignature($this->Signature);
        $gateway->setTestMode($this->Sandbox);
        $response = $gateway->completePurchase($this->param)->send();
        $paypalResponse = $response->getData();
          if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {

            return true;
        }
        else {
          return false;
        }
      }


  }
