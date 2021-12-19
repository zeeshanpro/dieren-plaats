<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        'current_password',
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
            //
        });

        $this->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('base_url');
            };

            if ($this->isHttpException($e)) {
                if ($e->getStatusCode() == 404) {
                    return redirect()->route('base_url');
                }
            }

        });
    }

// public function render($request, Exception $e)
    // {
    //     if($this->isHttpException($e))
    //     {
    //         switch (intval($e->getStatusCode())) {
    //             // not found
    //             case 404:
    //                 return redirect()->route('base_url');
    //                 break;
    //             // internal error
    //             case 500:
    //                 return \Response::view('custom.500',array(),500);
    //                 break;

//             default:
    //                 return redirect()->route('base_url');
    //                 break;
    //         }
    //     }

//         return parent::render($request, $e);
    // }

}
