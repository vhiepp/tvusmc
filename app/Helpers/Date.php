<?php

namespace App\Helpers;

class Date {

    public static function getNow() {
        $date = date('Y-m-d H:i:s');
        $newdate = strtotime('+7 hour', strtotime($date));
        $timeNow = date('Y-m-d H:i:s', $newdate);
        return $timeNow;
    }

    public static function fomatDateInput($date) {

        $r = null;

        if (str()->of($date)->contains(' ')) {
            $arr = str()->of($date)->explode(' ');

            $arr1 = str()->of($arr[1])->explode('/');

            $r = $arr1[2] . '-' . $arr1[1] . '-' . $arr1[0] . 'T' . $arr[0];

        } else {

            $arr = str()->of($date)->explode('/');

            $r = $arr[2] . '-' . $arr[1] . '-' . $arr[0] . 'T00:00';

        }

        return $r;

    } 

}