<?php
if (!function_exists('convertStringToNumber')) {
    function convertStringToNumber($string)
    {
        $inputString = $string;
        $convertToFloat = (float)$inputString;
        return number_format($convertToFloat);
    }
}
