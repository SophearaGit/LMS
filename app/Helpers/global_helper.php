<?php

// MinToHours function to convert minutes to hours and minutes format
if (!function_exists('minToHours')) {
    function minToHours($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        return sprintf('%dh %02dmin', $hours, $remainingMinutes);
    }
}
