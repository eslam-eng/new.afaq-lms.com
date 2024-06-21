<?php

namespace App\Payments\Gateways;

interface GatewayInterface {

    public function pay($invoiceData);
    
}
