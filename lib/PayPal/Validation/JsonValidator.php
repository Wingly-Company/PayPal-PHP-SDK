<?php

namespace PayPal\Validation;

use Stringable;

/**
 * Class JsonValidator
 *
 * @package PayPal\Validation
 */
class JsonValidator
{

    /**
     * Helper method for validating if string provided is a valid json.
     *
     * @param string $string String representation of Json object
     * @param bool $silent Flag to not throw \InvalidArgumentException
     * @return bool
     */
    public static function validate($string, $silent = false)
    {
        if ($string === '' || $string === null) {
            return true;
        }

        if (! is_string($string) && ! $string instanceof Stringable) {
            if ($silent == false) {
                throw new \InvalidArgumentException("Invalid JSON String");
            }

            return false;
        }

        json_decode($string);

        if (json_last_error() != JSON_ERROR_NONE) {
            if ($silent == false) {
                //Throw an Exception for string or array
                throw new \InvalidArgumentException("Invalid JSON String");
            }
            return false;
        }

        return true;
    }
}
