<?php

namespace App\Libraries;

use DateTime;
use Exception;
use DateInterval;

class DatetimeUtils
{
    const SECONDS = "s";
    const MINUTES = "m";
    const HOURS = "h";
    const DAYS = "d";

    public static function getIntervalUnits(DateInterval $interval, $unit) {
        // Day
        $total = $interval->format('%a');
        if ($unit == static::DAYS)
            return $total;
        //hour
        $total = ($total * 24) + ($interval->h);
        if ($unit == static::HOURS)
            return $total;
        //min
        $total = ($total * 60) + ($interval->i);
        if ($unit == static::MINUTES)
            return $total;
        //sec
        $total = ($total * 60) + ($interval->s);
        if ($unit == static::SECONDS)
            return $total;

        return false;
    }

    public static function getDatetime($date): ?DateTime {
        if (!empty($date)) {

            if (!is_string($date) && get_class($date) == DateTime::class) {
                return $date;
            }

            if (is_numeric($date)) {
                $date = (new DateTime())->setTimestamp($date);
                return $date;
            }

            try {
                $date = new DateTime($date);
            } catch (Exception $e) {
                $date = null;
            }
        }

        if ($date === false) {
            $date = null;
        }

        return $date;
    }

    public static function getDateForDB($date, ?string $format = "Y-m-d H:i:s") {
        $date = static::getDatetime($date);
        return $date->format($format);
    }
}
