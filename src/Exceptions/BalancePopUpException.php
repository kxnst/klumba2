<?php


namespace Kl\Exceptions;


use Throwable;

class BalancePopUpException extends \Exception
{
    public function __construct($message = 'Failed to pop up user balance', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}