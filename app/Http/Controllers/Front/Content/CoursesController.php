<?php

namespace App\Http\Controllers\Front\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHash(Request $request)
    {

        $api_key = "CDzJmVkZTzKXAQTE2_0bg";
        $api_sercet = "4QDvtZ6Qs3qvglAk3jR2a14EX24kJuzU";
         $meeting_number = $request->meeting_number;
         $role = 0;
        $time = time() * 10- 30; //time in milliseconds (or close enough)

        $data = base64_encode($api_key . $meeting_number . $time . $role);

        $hash = hash_hmac('sha256', $data, $api_sercet, true);

        $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);

        //return signature, url safe base64 encoded
        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
    }
}
