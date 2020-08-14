<?php

/**
 * Format Number for amounts of transactions
 *
 * @param $number
 * @return string
 */
function format_number($number)
{
    $number = number_format($number, 0, '', ' ');

    return str_replace('-', '- ', $number);
}

function isSelected($monthKey, $req, $format = null)
{
    $return = 'selected';
    if (request($req)) {
        if ($monthKey == request($req)) {
            return $return;
        }
    }
    else{
        if ($monthKey == date($format)) {
            return $return;
        }
    }
}
