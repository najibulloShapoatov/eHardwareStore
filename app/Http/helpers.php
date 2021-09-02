<?php
use Carbon\Carbon;
if (! function_exists('myGetDate')) {
    function myGetDate()
    {
        $mytime = Carbon::now()->format('F');
        return $mytime;
    }
}

function sklonenie($n) {
    $forms = array('отзыв', 'отзыва', 'отзывов');
    return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
}