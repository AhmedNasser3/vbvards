<?php

if (!function_exists('convertToArabicNumbers')) {
    /**
     * Convert English numbers to Arabic numbers.
     *
     * @param  string $number
     * @return string
     */
    function convertToArabicNumbers($number)
    {
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        return str_replace($englishNumbers, $arabicNumbers, $number);
    }
}

if (!function_exists('arabicNumber')) {
    /**
     * Blade directive to convert number to Arabic numbers.
     *
     * @param  string $number
     * @return string
     */
    function arabicNumber($number)
    {
        return convertToArabicNumbers($number);
    }
}
