<?php

namespace App\Payments;

use App\Payments\Gateways\MyFatoorah\MyFatoorah;
use App\Payments\Gateways\Bank\Bank;
use App\Payments\Gateways\Free\Free;
use App\Models\PaymentMethod;

class Factory
{

    public static function make($method_id = null)
    {
        $method = PaymentMethod::find($method_id);
        if ($method) {

            $class = "App\Payments\Gateways\\" . $method->provider . "\\" . $method->provider;
            return new $class($method->provider_method_id);
        }

        return new Free;
    }
}
