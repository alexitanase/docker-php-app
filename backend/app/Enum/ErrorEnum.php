<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;
use UnexpectedValueException;

/**
 * @method static ErrorEnum SUCCESS()
 * @method static ErrorEnum GENERIC_ERROR()
 * @method static ErrorEnum FARMER_ERROR()
 * @method static ErrorEnum INTERNAL_ERROR()
 * @method static ErrorEnum HTTP_ERROR()
 */
class ErrorEnum extends Enum
{
    
    public const SUCCESS = 0;
    public const GENERIC_ERROR = -1;
    public const FARMER_ERROR = -2;
    public const INTERNAL_ERROR = -100;
    public const HTTP_ERROR = -404;
    
    public function __construct($value) {
        try {
            parent::__construct($value);
        } catch (UnexpectedValueException $e) {
            parent::__construct(self::INTERNAL_ERROR);
        }
    }
    
}