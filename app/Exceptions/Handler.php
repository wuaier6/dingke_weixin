<?php

namespace App\Exceptions;

use App\Common\MessageHelper;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Overtrue\Socialite\InvalidStateException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use EasyWeChat\Server\BadRequestException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use  App\Common\Log\MySQLHandler;
use Log;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        if ($e instanceof NotFoundHttpException) {
            return response()->view('errors.503');
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->view('errors.503');
        }
        if ($e instanceof BadRequestException) {
            return response()->view('errors.503');
        }
        if ($e instanceof InvalidStateException) {
            return response()->view('errors.503');
        }
        if ($e instanceof ZZMedException) {
            Log::debug('request:' .json_encode($request->all())."response:". json_encode(array('code' => $e->getMessage(), 'data' => MessageHelper::GET($e->getMessage()))));
            return response()->json(array('code' => $e->getMessage(), 'data' => MessageHelper::GET($e->getMessage())), 400);
        }
        return parent::render($request, $e);
    }
}
