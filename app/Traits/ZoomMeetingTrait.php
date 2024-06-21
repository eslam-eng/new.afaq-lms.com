<?php

namespace App\Traits;

use App\Models\User;
use App\Models\ZoomMeeting;
use App\Models\ZoomReport;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/**
 * trait ZoomMeetingTrait
 */
trait ZoomMeetingTrait
{
    public $client;
    public $jwt;
    public $headers;
    public $meeting_type = 'webinars';

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false
        ]);

        $this->jwt = $this->generateZoomToken();
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->jwt,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function generateZoomToken()
    {
        $url ="https://zoom.us/oauth/token?grant_type=account_credentials&account_id=uAuzT1OLSfC8u6wIoGRW7A";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization:Basic '.base64_encode('CDzJmVkZTzKXAQTE2_0bg:4QDvtZ6Qs3qvglAk3jR2a14EX24kJuzU') ,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute post
        $result = curl_exec($ch);

        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }
        // Close connection
        curl_close($ch);
        $res = json_decode($result, true);
        if(isset($res['access_token'])){
            return $res['access_token'];
        }else{
            return $res;
        }
    }

    private function retrieveZoomUrl()
    {
        return config('app.ZOOM_API_URL');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());

            return '';
        }
    }

    public function create_metting($data)
    {
        $this->meeting_type = isset($data['meeting_type']) ? $data['meeting_type'] : 'meetings';

        $path = 'users/me/' . $this->meeting_type;
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => $this->headers,
            'body' => json_encode([
                'topic' => $data['topic'],
                'start_time' => date('Y-m-d\TH:i:s', strtotime($data['start_time'])), // $this->toZoomTimeFormat($data['start_time']),
                'duration' => $data['duration'],
                'agenda' => (!empty($data['agenda'])) ? $data['agenda'] : null,
                'type' => 5,
                'password' => $data['password'] ?? null,
                'default_password' => false,
                'timezone' => config('app.timezone'),
                'settings' => [
                    'audio' => ($data['audio'] == "both") ? 'both'  : 'voip',
                    'auto_recording' => ($data['auto_recording'] == "none") ? 'local'  : 'cloud',
                    'mute_upon_entry' => ($data['mute_upon_entry'] == "1") ? true : false,
                    'watermark' => ($data['watermark'] == "1")  ? true : false,
                    'host_video' => ($data['host_video'] == "1") ? true : false,
                    'participant_video' => ($data['participant_video'] == "1") ? true : false,
                    'waiting_room' => ($data['waiting_room'] == "1") ? true : false,
                    'meeting_authentication' => false,
                    'registrants_confirmation_email' => false,
                ],
                'panelists_invitation_email_notification' => true,
            ]),
        ];

        $response = $this->client->post($url . $path, $body);

        if ($response->getStatusCode() === 201) {

            $result = json_decode($response->getBody(), true);

            return [
                'course_id' => $data['course_id'] ?? null,
                'meeting_id' => $result['id'] ?? null,
                'start_url'  => $result['start_url'] ?? null,
                'join_url' => $result['join_url'] ?? null,
                'status' => 1 ?? null,
                'all_data' => json_encode($result ?? null, true) ?? null,
                'topic'  => $result['topic'] ?? null,
                'start_time' => $result['start_time'] ?? null,
                'duration' => $result['duration'] ?? null,
                'agenda' => $result['agenda'] ?? null,
                'host_video' => $result['settings']['host_video'] ?? null,
                'participant_video' => $result['settings']['participant_video'] ?? null,
                'password' => $result['password'] ?? null,
                'default_password' => isset($result['password']) ? true : false ?? null,
                'type' => ZoomMeeting::TYPE_SELECT[$result['type']] ?? null,
                'audio' => ZoomMeeting::AUDIO_SELECT[$result['settings']['audio']] ?? null,
                'auto_recording' => ZoomMeeting::AUTO_RECORDING_SELECT[$result['settings']['auto_recording']] ?? null,
                'alternative_hosts' =>  $result['settings']['alternative_hosts'] ?? null,
                'mute_upon_entry' => $result['settings']['mute_upon_entry'] ?? null,
                'watermark' => $result['settings']['watermark'] ?? null,
                'waiting_room' => $result['settings']['waiting_room'] ?? null,
                'meeting_type' => $data['meeting_type'] ?? null
            ];
        }

        return false;
    }

    public function update_meeting($id, $data)
    {
        $this->meeting_type = isset($data['meeting_type']) ? $data['meeting_type'] : 'meetings';
        $path = $this->meeting_type . '/' . $id;
        $url = $this->retrieveZoomUrl();

        $body = [
            'headers' => $this->headers,
            'body' => json_encode([
                'topic' => $data['topic'],
                'start_time' => date('Y-m-d\TH:i:s', strtotime($data['start_time'])), // $this->toZoomTimeFormat($data['start_time']),
                'duration' => $data['duration'],
                'agenda' => (!empty($data['agenda'])) ? $data['agenda'] : null,
                'type' => 2,
                'password' => $data['password'] ?? null,
                'default_password' => false,
                'timezone' => config('app.timezone'),
                'settings' => [
                    'audio' => ($data['audio'] == "both") ? 'telephony'  : 'voip',
                    'auto_recording' => ($data['auto_recording'] == "none") ? 'local'  : 'cloud',
                    'mute_upon_entry' => ($data['mute_upon_entry'] == "1") ? true : false,
                    'watermark' => ($data['watermark'] == "1")  ? true : false,
                    'host_video' => ($data['host_video'] == "1") ? true : false,
                    'participant_video' => ($data['participant_video'] == "1") ? true : false,
                    'waiting_room' => ($data['waiting_room'] == "1") ? true : false,
                    'meeting_authentication' => false,
                    'registrants_confirmation_email' => false,
                ],
            ]),
        ];

        $response = $this->client->patch($url . $path, $body);

        if ($response->getStatusCode() === 204) {
            return true;
        }

        return false;
    }

    public function get($id, $meeting_type = 'webinars')
    {
        $this->meeting_type = isset($meeting_type) ? $meeting_type : 'meetings';
        $path = $this->meeting_type . '/' . $id;

        $url = $this->retrieveZoomUrl();
        $this->jwt = $this->generateZoomToken();
        $body = [
            'headers' => $this->headers,
            'body' => json_encode([]),
        ];

        $response = $this->client->post($url . $path, $body);

        return [
            'success' => $response->getStatusCode() >= 200 || $response->getStatusCode() <= 204,
            'data' => json_decode($response->getBody(), true),
        ];
    }

    public function delete($id, $meeting_type = 'webinars')
    {
        $this->meeting_type = isset($meeting_type) ? $meeting_type : 'meetings';
        $path = $this->meeting_type . '/' . $id;
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => $this->headers,
            'body' => json_encode([]),
        ];

        $response = $this->client->delete($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
        ];
    }

    public function reports_meeting($id, $meeting_type = 'webinars')
    {
        $ZoomMeeting = ZoomMeeting::where('meeting_id', $id)->first();
        $this->meeting_type = isset($meeting_type) ? $meeting_type : 'meetings';
        $path = 'report/' . $this->meeting_type . '/' . $id . '/participants';
        $url = $this->retrieveZoomUrl();
        $this->jwt = $this->generateZoomToken();

        $body = [
            'headers' => $this->headers,
            'body' => json_encode([]),
        ];

        $response = $this->client->get($url . $path . '?page_size=300', $body);

        $page = $response->getStatusCode() >= 200 || $response->getStatusCode() <= 204 ? json_decode($response->getBody(), true)['page_count'] : 1;

        $all = [];
        for ($i = 1; $i <= $page; $i++) {
            $response = $this->client->get($url . $path . '?page_size=300&page=' . $i, $body);
            if ($response->getStatusCode() >= 200 || $response->getStatusCode() <= 204) {
                $result = json_decode($response->getBody(), true);
                foreach ($result['participants'] as $key => $x) {
                    $u = $x['name'] ? User::where('email', $x['name'])->first() : null;
                    $x['user_id'] = $u ? $u->id : $x['user_id'];
                    $x['duration']  = round($x['duration'] > 0 ? ($x['duration'] / 60) : 0, 2);
                    $x['report_id'] = $x['id'];
                    $x['meeting_id'] = $id;
                    $x['join_time'] = date('Y-m-d H:i:s', strtotime($x['join_time']));
                    $x['leave_time'] = date('Y-m-d H:i:s', strtotime($x['leave_time']));
                    $x['name'] = $u ? $u->full_name_en: '';
                    $x['user_email'] = $u ? $u->email: '';
                    if ($x['duration'] > 0) {
                        $percentage = round(($x['duration'] >= $ZoomMeeting->duration) ? "100" : (($x['duration'] / $ZoomMeeting->duration) * 100), 2);

                        $x['join_percentage'] = $percentage >= 100 ? "100" : $percentage;
                    } else {
                        $x['join_percentage'] = 0;
                    }
                    unset($x['id']);
                    unset($x['participant_user_id']);
                    if($x['status'] == 'in_meeting'){
                        array_push($all, $x);
                    }

                }
            }
        }

        $result = count($all) > 1 ? array_values(array_reduce($all, function ($carry, $item) {
            if (!isset($carry[$item['report_id']])) {
                $carry[$item['report_id']] = $item;
            } else {
                $carry[$item['report_id']]['join_percentage'] += $item['join_percentage'];
            }
            return $carry;
        })) : $all;

        if ($result) {
            foreach ($result as $value) {
                # code...

                ZoomReport::updateOrCreate(['user_email'=>$value['user_email']],$value);

            }
        }


        return $response->getStatusCode() >= 200 || $response->getStatusCode() <= 204 ? true : false;
    }

    public function invite($id, $meeting_type = 'webinars', $zoom = null)
    {
        if ($zoom) {
            $this->meeting_type = isset($meeting_type) ? $meeting_type : 'meetings';
            $path =  $this->meeting_type . "/" . $id . "/batch_registrants";

            $url = $this->retrieveZoomUrl();
            $this->jwt = $this->generateZoomToken();
            $body = [
                'headers' => $this->headers,
                'body' => json_encode([
                    'auto_approve' => true,
                    "registrants" => $zoom ? $zoom->course->users->map(function ($i) {
                        return [
                            "email" =>  $i['email'] ?? null,
                            "first_name" => $i['full_name_en'] ?? null,
                            "last_name" => ""
                        ];
                    }) : []
                ]),
            ];

            $response = $this->client->post($url . $path, $body);

            return [
                'success' => $response->getStatusCode() >= 200 || $response->getStatusCode() <= 204,
                'data' => json_decode($response->getBody(), true),
            ];
        }
    }

    public function getToken() {
        $token = $this->generateZoomToken();
        $url ="https://api.zoom.us/v2/users/me";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Execute post
        $result = curl_exec($ch);

        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }
        // Close connection
        curl_close($ch);

        $res = json_decode($result, true);
        if(isset($res['access_token'])){
            return $res['access_token'];
        }else{
            return $res;
        }
    }
}
