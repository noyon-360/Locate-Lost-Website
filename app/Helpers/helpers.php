<?php

if (!function_exists('highlight')) {
    function highlight($text, $search)
    {
        if (!$search) {
            return $text;
        }
        return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark class="font-bold">$1</mark>', $text);
    }
}

// composer dump-autoload
