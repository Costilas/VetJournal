<?php

return [
    'tab_title' => 'Претрага карата',

    'view' => [

        'create_form_expand' => 'Креирај нову карту',

        'create' => [
            'form' => [
                'owner' => [
                    'title' => 'Власник:',

                    'fields' => [
                        'last_name' => [
                            'label' => 'Презиме власника:',
                            'placeholder' => 'Петровић',
                        ],
                        'name' => [
                            'label' => 'Име власника:',
                            'placeholder' => 'Иван',
                        ],
                        'patronymic' => [
                            'label' => 'Очево име власника:',
                            'placeholder' => 'Ивановић',
                        ],
                        'phone' => [
                            'label' => 'Телефон:',
                            'placeholder' => 'Телефон',
                        ],
                        'additionalPhone' => [
                            'label' => 'Додатни телефон:',
                            'placeholder' => 'Додатни телефон',
                        ],
                        'email' => [
                            'label' => 'Е-маил адреса:',
                            'placeholder' => 'primer@nekimejl.com',
                        ],
                        'address' => [
                            'label' => 'Адреса власника (у слободној форми):',
                            'placeholder' => 'Београд,...',
                        ],
                    ],
                ],
                'pet' => [
                    'title' => 'Кућни љубимац:',

                    'fields' => [
                        'pet_name' => [
                            'label' => 'Име кућног љубимца:',
                            'placeholder' => 'Бони',
                        ],
                        'birth' => [
                            'label' => 'Датум рођења кућног љубимца:',
                        ],
                        'kind' => [
                            'label' => 'Врста кућног љубимца:',
                        ],
                        'gender' => [
                            'label' => 'Пол кућног љубимца:',
                        ],
                        'castration' => [
                            'label' => 'Кастрација:',
                        ],
                    ],
                ],
                'buttons' => [
                    'card_create' => 'Креирај',
                ],
            ],
        ],

        'search' => [
            'form' => [
                'title' => 'Претрага постојећих:',

                'search_by_filters' => 'Претрага по филтерима:',
                'fields' => [
                    'lastName' => [
                        'placeholder' => 'Презиме',
                    ],
                    'name' => [
                        'placeholder' => 'Име',
                    ],
                    'patronymic' => [
                        'placeholder' => 'Очево име',
                    ],
                    'phone' => [
                        'placeholder' => 'Телефон',
                    ],
                    'additionalPhone' => [
                        'placeholder' => 'Електронска пошта',
                    ],
                    'email' => [
                        'placeholder' => 'E-mail',
                    ],
                    'pets' => [
                        'placeholder' => 'Име кућног љубимца',
                    ],
                ],
                'buttons' => [
                    'card_search' => 'Претрага',
                    'search_filter_reset' => 'Ресетуј филтере претраге',
                ],
            ],
            'table' => [
                'columns' => [
                    'owner_name' => 'Име и презиме:',
                    'actions' => 'Акција:',
                    'owner_email' => 'Емаил:',
                    'owner_pets' => 'Кућни љубимци:',
                    'owner_phone' => 'Телефон:',
                    'owner_address' => 'Адреса:',
                    'owner_additional_phone' => 'Додатни телефон:',
                ],
                'no_results' => 'Нема резултата за унете податке. Проверите исправност уноса.',
                'actions' => [
                    'owner' => 'Детаљније',
                ]
            ],
        ],
    ],

    'notifications' => [
        'create' => [
            'fail' => 'Креирање нове карте није успело',
            'success' => 'Нова карта је успешно креирана',
        ],
    ],
];

