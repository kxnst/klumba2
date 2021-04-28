<?php


namespace Kl\Exceptions;


class NegativeBalanceException extends \Exception
{
    public function __construct($message = 'Balance can`t be less then 0', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}