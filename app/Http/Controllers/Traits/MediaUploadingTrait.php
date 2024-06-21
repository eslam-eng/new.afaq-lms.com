<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 2048,
            ]);
        }

        // If width or height is preset - we are validating it as an image
        //   if (request()->has('width') || request()->has('height')) {
        //      $this->validate(request(), [
        //          'file' => sprintf(
        //             'image|dimensions:max_width=%s,max_height=%s',
        //            request()->input('width', 100000),
        //            request()->input('height', 100000)
        //        ),
        //    ]);
        // }

        $path = storage_path('tmp/uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        if ($request->type == 'video') {
            $name = upload_video_to_s3($file);
        } else {
            $name = uniqid() . '_' . time() . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $name);
        }
        $data = [
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ];
        return response()->json($data);
    }
}
