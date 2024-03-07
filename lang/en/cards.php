<?php

return [
    'tab_title' => 'Card search',

    'view' => [

        'create_form_expand' => 'Create new card',

        'create' => [
            'form' => [
                'owner' => [
                    'title' => 'Owner:',

                    'fields' => [
                        'last_name' => [
                            'label' => 'Owner\'s last name:',
                            'placeholder' => 'Smith',
                        ],
                        'name' => [
                            'label' => 'Owner\'s first name:',
                            'placeholder' => 'John',
                        ],
                        'patronymic' => [
                            'label' => 'Owner\'s patronymic:',
                            'placeholder' => 'Thomas',
                        ],
                        'phone' => [
                            'label' => 'Phone number:',
                            'placeholder' => 'Phone number',
                        ],
                        'additionalPhone' => [
                            'label' => 'Additional phone:',
                            'placeholder' => 'Additional phone',
                        ],
                        'email' => [
                            'label' => 'Email address:',
                            'placeholder' => 'example@somemail.com',
                        ],
                        'address' => [
                            'label' => 'Owner\'s address (in free form):',
                            'placeholder' => '123 Main St, Anytown',
                        ],
                    ],
                ],
                'pet' => [
                    'title' => 'Pet:',

                    'fields' => [
                        'pet_name' => [
                            'label' => 'Pet\'s name:',
                            'placeholder' => 'Max',
                        ],
                        'birth' => [
                            'label' => 'Pet\'s birth date:',
                        ],
                        'kind' => [
                            'label' => 'Animal type:',
                        ],
                        'gender' => [
                            'label' => 'Pet\'s gender:',
                        ],
                        'castration' => [
                            'label' => 'Castration condition:',
                        ],
                    ],
                ],
                'buttons' => [
                    'card_create' => 'Create',
                ],
            ],
        ],

        'search' => [
            'form' => [
                'title' => 'Search existing:',

                'search_by_filters' => 'Search by filters:',
                'fields' => [
                    'lastName' => [
                        'placeholder' => 'Last name',
                    ],
                    'name' => [
                        'placeholder' => 'First name',
                    ],
                    'patronymic' => [
                        'placeholder' => 'Patronymic',
                    ],
                    'phone' => [
                        'placeholder' => 'Phone number',
                    ],
                    'additionalPhone' => [
                        'placeholder' => 'Additional phone number',
                    ],
                    'email' => [
                        'placeholder' => 'E-mail',
                    ],
                    'pets' => [
                        'placeholder' => 'Pet\'s name',
                    ],
                ],

                'buttons' => [
                    'card_search' => 'Search',
                    'search_filter_reset' => 'Reset search filters',
                ],
            ],
            'table' => [
                'columns' => [
                    'owner_name' => 'Full name:',
                    'actions' => 'Action:',
                    'owner_email' => 'Email:',
                    'owner_pets' => 'Pets:',
                    'owner_phone' => 'Phone:',
                    'owner_address' => 'Address:',
                    'owner_additional_phone' => 'Additional phone:',
                ],
                'no_results' => 'No results found for the entered data. Please check the accuracy of the fields.',
                'actions' => [
                    'owner' => 'More details',
                ]

            ],

        ],
    ],

    'notifications' => [
        'create' => [
            'fail' => 'Failed to create new card',
            'success' => 'New card successfully created',
        ],
    ],
];

