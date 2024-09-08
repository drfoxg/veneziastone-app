<?php

namespace App\Http\Controllers;

use App\Interfaces\CartInterface;
use App\Http\Order;
use App\Http\SimpleMailerService;

class CartController implements CartInterface
{
    public $items;
    public $order = null;
    public $mailService;

    private const VAT = 0.18;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function calcVat()
    {
        $vat = 0;
        foreach ($this->items as $item) {
            $vat += $item->getPrice() * static::VAT;
        }
        return $vat;
    }

    public function notify()
    {
        if (isset($this->order)) {
            $this->mailService->sendMail();
        } else {
            throw new \Exception('No order.');
        }
    }

    public function makeOrder($discount = 1.0)
    {
        $price = 0;
        $cost = 1 + static::VAT;

        foreach ($this->items as $item) {
            $price += $item->getPrice() * $cost * $discount;
        }

        $this->order = new Order($this->items, $price);
        $this->mailService = new SimpleMailerService($this->order->id(), $price);
        $this->mailService->sendMail();
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    /*
    private function sendMail()
    {
        $mailer = new SimpleMailer('cartuser', 'j049lj-01');

        $message = $this->getMessage($this->order->id(), $this->price);

        $mailer->sendToManagers($message);
    }

    private function getMessage($id, $price)
    {
        $message = "<p> <b>{$id}</b> {$price} .</p>";
        return $message;
    }
    */
}
