<?php

namespace App\Payments\Gateways\MyFatoorah;

class Config
{
    public static $MODE = "live";

    public static $API_URL = "https://api.myfatoorah.com/v2/";
    public static $API_KEY = "y6-e5FW3KPILNkAbKtuRifVX9uOuApGGTe-SuoC4warZTtr-c4ysDR3dmJMjPiLtqFiW2_fNkDXidajRN8yb-l_qt9CmzZyKMgQz9sgVyk2ODHzjHnawH9MGep42UUw7371BENCII2DTqB2WAKF76qLUbhst2y5bHnZbUmFtqqUW4RCSnD8ISMIlJAmNfS-7kPTl18ghv4QQW0DhJ6WxqYyDaGaPrvc8t67K0b5KqfzjO8w9hNk1ZEk4JJh6UrDxX5MCBjmRDL48_byaSn7MjzVtKJ1gy3_t8mYsw737Qo69qZjvA16LWIFa3lqJtAUpuRrj9M3SaN1ymoXLPfsfrWa3g6B8KwU7ROvc9biMF8N7Xj0-oyj33ljhwqA4x66CDFiGH8xFOA-Yp0HymYnrXGH_8Fpvz0B22rGzVw5w2OEmxKf7kUVFn_1HiXZzkRXiK25_uOhwPgtQ8FQFgrlJp7sH88FvprT44-TLxHfEU4E6egqo0wTSILzgEUlguvVm1-Gg-rr3pQj9m8Ut7mu8bpO2Cf9wEDdqAZ_Py4NyhdXWsmZ51EP9w_yYJUflBDTZK6o0mxPL_n08xqlFTsTvzuGulOp0HD2g87JJwryk1nHo28lFEJIe7BRnQN2nHNVVt_73vL8R9BKYe68c2oWS_8Eq85MFsyN6pKdY4hY3oAcdhuqPAMZ1evsyAKmEGhJMqGwPqQ";

    public static $TEST_API_URL = "https://apitest.myfatoorah.com/v2/";
    public static $TEST_API_KEY = "rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL";

    public static $CALLBACK_URL = "/ar/checkout/pay/complete";
    public static $ERROR_URL = "/ar/checkout/pay/error";

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
