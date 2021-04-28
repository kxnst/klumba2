<?php


namespace Kl\Exceptions;


use Throwable;

class WrongEmailException extends \Exception
{
    public function __construct($message = "Wrong email", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}