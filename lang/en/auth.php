<?php

return [
    'tab_title' => 'Login',

    'view' => [
        'welcome' => 'Welcome to VetJournal!',
        'login_title' => 'Login:',
        'password_title' => 'Password:',
    ],

    'buttons' => [
        'enter_button' =>  'Enter',
    ],

    'notifications' => [
        'login' => [
            'success' => [
                'first_part' => 'Welcome',
                'last_part' => 'You have successfully logged in!',
            ],
            'failed' => 'The data is incorrect or your profile is blocked',
        ],
        'logout' => [
            'success' => 'You have successfully logged out!',
        ],
    ],
];
