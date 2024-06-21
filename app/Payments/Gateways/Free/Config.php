<?php

namespace App\Payments\Gateways\Free;

class Config
{
    public static $MODE = "live";

    public static $CALLBACK_URL = "/ar/checkout/pay/complete";
    public static $ERROR_URL = "/ar/checkout/pay/error";

    public static $TEST_CALLBACK_URL = "/ar/checkout/pay/complete";
    public static $TEST_ERROR_URL = "/ar/checkout/pay/error";

    public static $SUCCESS_URL = "/ar/mycourses";
    public static $TEST_SUCCESS_URL = "/ar/mycourses";


    public function __construct()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $domain = "https://";
        else
            $domain = "http://";
        // Append the host(domain name, ip) to the domain.   
        $domain .= config('app.APP_URL' , $_SERVER['HTTP_HOST']);

        $this->CALLBACK_URL = $domain . $this->CALLBACK_URL;
        $this->ERROR_URL = $domain . $this->ERROR_URL;
        $this->TEST_CALLBACK_URL = $domain . $this->TEST_CALLBACK_URL;
        $this->TEST_ERROR_URL = $domain . $this->TEST_ERROR_URL;
        $this->SUCCESS_URL = $domain . $this->SUCCESS_URL;
        $this->TEST_SUCCESS_URL = $domain . $this->TEST_SUCCESS_URL;
    }

}

