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
