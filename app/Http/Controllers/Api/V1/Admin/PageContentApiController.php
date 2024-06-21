<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ContentPageResource;
use App\Models\ContentPage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageContentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentPage  $contentPage
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        try {
            $content = ContentPage::where('title', $title)->first();

            return (new ContentPageResource($content))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
