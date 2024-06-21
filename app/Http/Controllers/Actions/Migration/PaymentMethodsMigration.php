<?php

namespace App\Http\Controllers\Actions\Migration;

use App\Http\Controllers\Actions\Migration\MigrateOldData;
use App\Models\PaymentMethod;
use App\Models\User;

class PaymentMethodsMigration extends MigrateOldData
{
    public function usersMigrate()
    {
        $payment_methods_data = self::migration('payment_methods');

        foreach ($payment_methods_data as $t) {
            PaymentMethod::create($t);
        }

        return true;
    }
}
