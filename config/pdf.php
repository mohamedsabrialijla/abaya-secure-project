<?php

return [
    'font_path' => public_path('fonts/Cairo'),
    'font_data' => [
        'examplefont' => [
            'R'  => 'Cairo-Regular.ttf',    // regular font
            'B'  => 'Cairo-Bold.ttf',       // optional: bold font
//            'I'  => 'Cairo-Italic.ttf',     // optional: italic font
//            'BI' => 'Cairo-Bold-Italic.ttf' // optional: bold-italic font
            //'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            //'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ]
        // ...add as many as you want.
    ],

	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Abaya Square app',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/')
];
