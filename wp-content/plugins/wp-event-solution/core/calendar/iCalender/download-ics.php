<?php
// download-ics.php

// Sanitize and get values
$start       = $_GET['date_start'] ?? '';
$end         = $_GET['date_end'] ?? '';
$summary     = $_GET['summary'] ?? '';
$location    = $_GET['location'] ?? '';
$description = $_GET['description'] ?? '';

// Format date as YYYYMMDD (for all-day event)
function format_date($datetime, $is_end = false) {
    $date = new DateTime($datetime, new DateTimeZone('UTC'));

    if ($is_end) {
        // Add 1 day to make DTEND exclusive per iCalendar spec
        $date->modify('+1 day');
    }

    return $date->format('Ymd');
}

// Send headers to download as .ics file
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=event.ics');

// Output ICS content
echo "BEGIN:VCALENDAR
VERSION:2.0
CALSCALE:GREGORIAN
BEGIN:VEVENT
SUMMARY:" . $summary . "
DTSTART;VALUE=DATE:" . format_date($start) . "
DTEND;VALUE=DATE:" . format_date($end, true) . "
DESCRIPTION:" . $description . "
LOCATION:" . $location . "
END:VEVENT
END:VCALENDAR";
exit;
