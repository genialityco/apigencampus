<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
        NotFoundHttpException::class
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
     * Determine if the exception is in the "do not report" list.
     *
     * @param  \Exception  $e
     * @return bool
     */
    protected function shouldntReport(Exception $e)
    {
        $dontReport = array_merge($this->dontReport, [HttpResponseException::class]);
        return !is_null(collect($dontReport)->first(function ($type) use ($e) {
            return $e instanceof $type;
        }));
    }
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception) && app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }
    
        parent::report($exception);
        //return;
        //parent::report($exception);
        /*if ($this->shouldntReport($e)) {
        echo "que paso";die;
        var_dump($e);die;
        return;
        }*/
        // echo "2.5";
        // try {echo " 3";
        //     $logger = $this->container->make(LoggerInterface::class);
        //     echo "4 ";
        // } catch (Exception $ex) {
        //     throw $e; // throw the original exception
        // }
        // $logger->error($e);
        // echo " report after ";
        // die("report");
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    /*public function render($request, Exception $e)
    {

    // If the request wants JSON (AJAX doesn't always want JSON)
    if (!$request->wantsJson()) {
    // Default to the parent class' implementation of handler
    return parent::render($request, $e);
    }
    // Define the response
    $response = [
    'error' => $e->getMessage()
    ];

    // If the app is in debug mode
    if (config('app.debug')) {
    // Add the exception class name, message and stack trace to response
    $response['exception'] = get_class($e); // Reflection might be better here
    $response['message'] = $e->getMessage();
    $response['trace'] = $e->getTrace();
    }

    // Default response of 400
    $status = 400;

    // If this exception is an instance of HttpException
    if ($this->isHttpException($e)) {
    // Grab the HTTP status code from the Exception
    $status = $e->getStatusCode();
    }

    // Return a JSON response with the response array and status code
    return response()->json($response, $status);

    }*/
    /*protected function renderHttpException(HttpException $e){
die("render HTTP exception");
return parent::renderHttpException($e);
}*/
}