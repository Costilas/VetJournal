<?php

return [
    'tab_title' => 'Поиск карт',

    'view' => [

        'create_form_expand' => 'Создать новую карту',

        'create' => [
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
                    'card_create' => 'Создать',
                ],
            ],
        ],

        'search' => [
            'form' => [
                'title' => 'Поиск по существующим:',

                'search_by_filters' => 'Поиск по фильтрам:',
                'fields' => [
                    'lastName' => [
                        'placeholder' => 'Фамилия',
                    ],
                    'name' => [
                        'placeholder' => 'Имя',
                    ],
                    'patronymic' => [
                        'placeholder' => 'Отчество',
                    ],
                    'phone' => [
                        'placeholder' => 'Телефон',
                    ],
                    'additionalPhone' => [
                        'placeholder' => 'Электронная почта',
                    ],
                    'email' => [
                        'placeholder' => 'Электронная почта',
                    ],
                    'pets' => [
                        'placeholder' => 'Кличка питомца',
                    ],
                ],

                'buttons' => [
                    'card_search' => 'Поиск',
                    'search_filter_reset' => 'Сброс фильтров поиска',
                ],
            ],
            'table' => [
                'columns' => [
                    'owner_name' => 'ФИО:',
                    'actions' => 'Действие:',
                    'owner_email' => 'Email:',
                    'owner_pets' => 'Питомцы:',
                    'owner_phone' => 'Телефон:',
                    'owner_address' => 'Адрес:',
                    'owner_additional_phone' => 'Доп. телефон:',
                ],
                'no_results' => 'Результатов по введенным данным нет. Проверьте правильность заполнения полей.',
                'actions' => [
                    'owner' => 'Подробнее',
                ]
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
