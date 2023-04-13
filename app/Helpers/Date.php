<?php

namespace App\Helpers;

class Date {

    public static function getNow() {
        $date = date('Y-m-d H:i:s');
        $newdate = strtotime('-5 hour', strtotime($date));
        $timeNow = date('Y-m-d H:i:s', $newdate);
        return $timeNow;
    }

}