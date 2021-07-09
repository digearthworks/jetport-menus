<?php

namespace Turbine\Exceptions;

use Exception;
use Throwable;

/**
 * Class GeneralException.
 */
class GeneralException extends Exception
{

    /**
     * @var
     */
    public $message;

    /**
     * GeneralException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {

        // All instances of GeneralException redirect back with a flash message


        if (app()->environment(['local', 'testing'])) {
            dd($this->message);
        }

        abort(500, 'Something is Wrong');
    }
}
