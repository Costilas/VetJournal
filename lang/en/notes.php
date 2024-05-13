<?php

return [
    'tab_title' => 'Notes',

    'view' => [
        'note' => [
            'priority' => 'Priority:',
        ],
        'placeholder' => [
            'theme' => 'Note theme',
            'text' => 'Note text',
        ],
    ],

    'buttons' => [],

    'notifications' => [
        'create' => [
            'success' => 'Note created!',
            'fail' => 'An error occurred while creating the note. Reload the page and try again.',
        ],
        'delete' => [
            'success' => 'Note deleted!',
            'fail' => 'An error occurred while deleting the note. Reload the page and try again.',
        ]
    ],
];
