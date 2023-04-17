<?php

namespace App\Enum\Exception;

use Throwable;
use Exception;
use App\Enum\ErrorEnum;

class AlertException extends Exception
{
    public function __construct($message = "", ErrorEnum $code, Throwable $previous = null) {


        parent::__construct($message, $code->getValue(), $previous);
    }
}