<?php

namespace App\Exceptions;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            return false;
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
//            return response()->json([
//                'status' => false,
//                'msg' => 'unauthorized',
//                'data' => null
//            ], 401);

            /****/
            // if ($exception->getCode() == 0) {
            //     return redirect()->back();
            // }
            /****/
            return redirect('/login');
        }

        // if ($exception->getCode() == 0 && !$request->expectsJson()) {
        //     return redirect()->back();
        // }
        return parent::render($request, $exception);
    }
}
