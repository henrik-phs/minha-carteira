<?php

function numberFormatBRL($value)
{
    return number_format($value, 2, ",", ".");
}

function dateFormat($date)
{
    if ($date)
        return date('d/m/Y', strtotime($date));
        else
        return "-";
}
