<?php

return [
    'tab_title' => 'Владелец:',

    'view' => [
        'edit' => [
            'form' => [
                'owner' => [
                    'title' => 'Владелец:',

                    'fields' => [
                        'last_name' => [
                            'label' => 'Фамилия владельца:',
                            'placeholder' => 'Петров',
                        ],
                        'name' => [
                            'label' => 'Имя владельца:',
                            'placeholder' => 'Иван',
                        ],
                        'patronymic' => [
                            'label' => 'Отчество владельца:',
                            'placeholder' => 'Иванович',
                        ],
                        'phone' => [
                            'label' => 'Телефон:',
                            'placeholder' => 'Телефон',
                        ],
                        'additionalPhone' => [
                            'label' => 'Дополнительный телефон:',
                            'placeholder' => 'Дополнительный телефон',
                        ],
                        'email' => [
                            'label' => 'Адрес электронной почты:',
                            'placeholder' => 'example@somemail.com',
                        ],
                        'address' => [
                            'label' => 'Адрес владельца(в произвольной форме):',
                            'placeholder' => 'г.Москва,...',
                        ],
                    ],
                ],
                'pet' => [
                    'title' => 'Питомец:',

                    'fields' => [
                        'pet_name' => [
                            'label' => 'Кличка питомца:',
                            'placeholder' => 'Боня',
                        ],
                        'birth' => [
                            'label' => 'Дата рождения питомца:',
                        ],
                        'kind' => [
                            'label' => 'Вид питомца:',
                        ],
                        'gender' => [
                            'label' => 'Пол питомца:',
                        ],
                        'castration' => [
                            'label' => 'Кастрация:',
                        ],
                    ],
                ],
                'buttons' => [
                    'owner_edit' => '',
                ],
            ],
        ],
    ],

    'notifications' => [
        'create' => [
            'fail' => 'Создание новой карточки не удалось',
            'success' => 'Новая карточка успешно создана',
        ],
    ],
];
