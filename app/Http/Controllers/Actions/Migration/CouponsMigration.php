<?php

namespace App\Http\Controllers\Actions\Migration;

use App\Http\Controllers\Actions\Migration\MigrateOldData;
use App\Models\CouponCode;
use App\Models\User;

class CouponsMigration extends MigrateOldData
{
    public function couponMigrate()
    {
        $coupon_data = self::migration('coupon_codes');

        foreach ($coupon_data as $t) {
            CouponCode::create($t);
        }

        self::courseCoupons();

        return true;
    }

    public function courseCoupons()
    {
        $coupon_course_data = self::migration('products_coupons');
        foreach ($coupon_course_data as $t) {
            $t['course_id'] = $t['product_id'];

            CouponCode::create($t);
        }

        return true;
    }
}
