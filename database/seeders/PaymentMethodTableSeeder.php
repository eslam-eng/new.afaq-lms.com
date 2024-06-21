<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name_en" => "VISA/MASTER",
                "name_ar" => "فيزا / ماستر",
                "provider_image" => "https://demo.myfatoorah.com/imgs/payment-methods/vm.png",
                "local_image" => "Null",
                "provider" => "MyFatoorah",
                "provider_method_id" => "2",
                "service_fees" => "6.3",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "Meeza",
                "name_ar" => "ميزة",
                "provider_image" => "https://portal.myfatoorah.com/imgs/payment-methods/mz.png",
                "local_image" => "Null",
                "provider" => "MyFatoorah",
                "provider_method_id" => "11",
                "service_fees" => "5.73",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "Mobile Wallet",
                "name_ar" => "محفظة الكترونية",
                "provider_image" => "https://portal.myfatoorah.com/imgs/payment-methods/mw.png",
                "local_image" => "Null",
                "provider" => "MyFatoorah",
                "provider_method_id" => "13",
                "service_fees" => "5.75",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "Bank Transfer",
                "name_ar" => "تحويل بنكي",
                "provider_image" => "https://w7.pngwing.com/pngs/859/737/png-transparent-wire-transfer-bank-payment-money-electronic-funds-transfer-bank-blue-text-service.png",
                "local_image" => "",
                "provider" => "Bank",
                "provider_method_id" => "4",
                "service_fees" => "6.3",
                "type" => "local",
                "mode" => "live",
                "status" => 1
            ],

            [
                "name_en" => "VISA",
                "name_ar" => "فيزا ",
                "provider_image" => "https://demo.myfatoorah.com/imgs/payment-methods/vm.png",
                "local_image" => "Null",
                "provider" => "Hyber",
                "provider_method_id" => "10000",
                "service_fees" => "15",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "MASTER",
                "name_ar" => " ماستر",
                "provider_image" => "https://demo.myfatoorah.com/imgs/payment-methods/vm.png",
                "local_image" => "Null",
                "provider" => "Hyber",
                "provider_method_id" => "10001",
                "service_fees" => "15",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "MADA",
                "name_ar" => " مدي",
                "provider_image" => "https://sna.myevntoo.info/storage/1113/conversions/untitled-2_27-thumb.jpg",
                "local_image" => "Null",
                "provider" => "Hyber",
                "provider_method_id" => "10002",
                "service_fees" => "15",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "STC_PAY",
                "name_ar" => " STC_PAY",
                "provider_image" => "https://sna.myevntoo.info/storage/1116/conversions/63692d269a984_166783722227071-thumb.jpg",
                "local_image" => "Null",
                "provider" => "Hyber",
                "provider_method_id" => "10003",
                "service_fees" => "15",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "TAMARA",
                "name_ar" => " TAMARA",
                "provider_image" => "https://sna.myevntoo.info/storage/1117/conversions/63692dba5da20_1667837370224-thumb.jpg",
                "local_image" => "Null",
                "provider" => "Hyber",
                "provider_method_id" => "10004",
                "service_fees" => "15",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],
            [
                "name_en" => "APPLEPAY",
                "name_ar" => " APPLEPAY",
                "provider_image" => "https://sna.myevntoo.info/storage/1118/conversions/63692dee7777d_166783742241825-thumb.jpg",
                "local_image" => "Null",
                "provider" => "Hyber",
                "provider_method_id" => "10005",
                "service_fees" => "15",
                "type" => "api",
                "mode" => "live",
                "status" => 1
            ],

            [
                "name_en" => "Free",
                "name_ar" => " مجاني",
                "provider_image" => "https://sna.myevntoo.info/storage/1118/conversions/63692dee7777d_166783742241825-thumb.jpg",
                "local_image" => "Null",
                "provider" => "Free",
                "provider_method_id" => "100006",
                "service_fees" => "0",
                "type" => "offline",
                "mode" => "live",
                "status" => 1
            ],
        ];
        PaymentMethod::insert($data);
    }
}
