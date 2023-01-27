<?php
if (!function_exists('my_format_date')) {
    function my_format_date($date)
    {
        $formatted_date = date("d-M-Y", strtotime($date));
        return $formatted_date;
    }
}
//₹
function price($amount)
{
    $len = strlen($amount);
    $rev = strrev($amount);
    $format_amount = "";
    $step = 1;
    if ($len > 3) {
        for ($i = 0; $i < $len; $i++) {
            if ($step % 3 == 0) {
                $format_amount .= $rev[$i] . ",";
            } else {
                $format_amount .= $rev[$i];
            }
            $step++;
        }
        $new_amount = "₹" . strrev($format_amount);
    } else {
        $new_amount = "₹" . $amount;
    }
    return $new_amount;
}