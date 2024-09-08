<?php

namespace App\Interfaces;

interface CartInterface
{
    public function calcVat();

    public function notify();

    public function makeOrder($discount);
}
