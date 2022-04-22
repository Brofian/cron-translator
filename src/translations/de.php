<?php declare(strict_types=1);

return [

    'weekdays' => [
        0 => 'Sonntag',
        1 => 'Montag',
        2 => 'Dienstag',
        3 => 'Mittwoch',
        4 => 'Donnerstag',
        5 => 'Freitag',
        6 => 'Samstag',
        7 => 'Sonntag'
    ],

    'months' => [
        1  => 'Januar',
        2  => 'Februar',
        3  => 'März',
        4  => 'April',
        5  => 'Mai',
        6  => 'Juni',
        7  => 'Juli',
        8  => 'August',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Dezember',
    ],

    'phrases' => [
        'minutes' => [
            'prefix' => '',
            'suffix' => '',
            'connection' => ' und ',
            'interval' => 'jede %s.Minute',
            'single' => 'Die %s.Minute',
            'always' => 'jede Minute',
            'range' => ' von %s bis %s'
        ],
        'hours' => [
            'prefix' => '',
            'suffix' => '',
            'connection' => ' und',
            'interval' => ' in jeder %s.Stunde',
            'single' => ' der %s.Stunde',
            'always' => '',
            'range_prefix' => '',
            'range' => ' von %02s Uhr bis %02s Uhr'
        ],
        'days' => [
            'prefix' => ' ',
            'suffix' => '',
            'connection' => ' und ',
            'interval' => 'an jedem %s.Tag',
            'single' => 'an jedem %s.Tag',
            'always' => '',
            'range_prefix' => 'an jedem Tag',
            'range' => ' vom %s. bis zum %s.'
        ],
        'months' => [
            'prefix' => ',',
            'suffix' => '',
            'connection' => ' und',
            'interval' => ' jeden %s.Monat',
            'single' => ' im %s',
            'always' => '',
            'range_prefix' => '',
            'range' => ' von %s bis %s'
        ],
        'weekdays' => [
            'prefix' => '',
            'suffix' => '',
            'connection' => ' und ',
            'interval' => ' an jedem %s.Wochentag',
            'single' => ' am einem %s',
            'always' => '',
            'range_prefix' => '',
            'range' => ' von %s bis %s'
        ],

        'combination' => [
            'clock' => 'Um %02s:%02s Uhr'
        ]
    ]

];