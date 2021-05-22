<?php
namespace App\helpers;

use stdClass;

class Helpers
{

    /**
     * Convert array to stdClass object.
     *
     * @param array $array
     * @return stdClass
     */
    public static function arrayToStdClass(array $array): stdClass
    {
        $object = new stdClass();

        foreach ($array as $key => $value)
        {
            if (is_array($value))
                $value = self::arrayToStdClass($value);

            $object->$key = $value;
        }

        return $object;
    }

    public static function getCentimPrice($price)
    {
        return number_format($price, 2, ',', ' ').' DZD';
    }

    public static function getDinarPrice($price)
    {
        return number_format($price, 0, ',', ' ').' DZA';
    }
}