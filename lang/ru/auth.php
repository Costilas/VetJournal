<?php

return [
    'tab_title' => 'Вход',

    'view' => [
        'welcome' => 'Добро пожаловать в VetJournal!',
        'login_title' => 'Логин:',
        'password_title' => 'Пароль:',
    ],

    'buttons' => [
        'enter_button' =>  'Войти',
    ],

    'notifications' => [
        'login' => [
            'success' => [
                'first_part' => 'Добро пожаловать',
                'last_part' => 'Вход успешно выполнен!',
            ],
            'failed' => 'Данные неверны или ваш профиль заблокирован',
        ],
        'logout' => [
            'success' => 'Выход выполнен!',
        ],
    ],
];
