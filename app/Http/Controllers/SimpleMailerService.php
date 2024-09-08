<?php

namespace App\Http\Controllers;

use App\SimpleMailer;

class SimpleMailerService
{
    private $cartuser;
    private $token;
    private $id;
    private $price;

    public function __construct($id, $price, $cartuser = 'cartuser', $token = 'j049lj-01')
    {
        $this->cartuser = $cartuser;
        $this->token = $token;
        $this->id = $id;
        $this->price = $price;
    }

    public function setCartuser($cartuser)
    {
        $this->cartuser = $cartuser;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function sendMail()
    {
        $mailer = new SimpleMailer($this->cartuser, $this->token);

        $message = $this->getMessage($this->id, $this->price);

        $mailer->sendToManagers($message);
    }

    private function getMessage($id, $price)
    {
        $message = "<p> <b>{$id}</b> {$price} .</p>";
        return $message;
    }

}
