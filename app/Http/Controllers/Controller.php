<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\UserLog;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function save_log($user_id, $log_message)
	{
		UserLog::firstOrCreate(['user_id' => $user_id, 'log_message' => $log_message]);
	}

	public function toJson($data = null,  $code = 200, $message = null, $status = true)
	{
		$result = [];
		$result['status'] = $status;
		$msg = $status ? 'sucess' : 'fail';
		$result['msg'] = $message ? $message : $msg;
		$result['data'] =  $data ?? null;
		return response()->json($result, $code);
	}
}
