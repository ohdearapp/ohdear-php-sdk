<?php

namespace OhDear\PhpSdk\Helpers;

use DateTime;
use InvalidArgumentException;

class Helpers
{
    public static function convertDateFormat(string $date): string
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        if ($dateTime === false) {
            throw new InvalidArgumentException("Invalid date format. Expected 'Y-m-d H:i:s' format.");
        }

        return $dateTime->format('YmdHis');
    }
}
