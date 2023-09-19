<?php

return [
    [
        'key' => 'recently_purchased',
        'name' => 'Recently Purchased',
        'sort' => 10
    ], [
        'key' => 'recently_purchased.settings',
        'name' => 'Settings',
        'sort' => 11,
    ], [
        'key' => 'recently_purchased.settings.settings',
        'name' => 'Settings',
        'sort' => 12,
        'fields' => [
            [
                'name' => 'status',
                'title' => 'Status',
                'type' => 'boolean',
                'channel_based' => true,
                'locale_based' => false
            ],
            [
                'name' => 'timer',
                'title' => 'Popup Timer (seconds)',
                'type' => 'text',
                'channel_based' => true,
                'locale_based' => false,
                'default_value' => '10',
            ],
            [
                'name'          => 'products_type',
                'title'         => 'Display product source',
                'type'          => 'select',
                'options'       => [
                    [
                        'title' => 'Featured',
                        'value' => 'featured',
                    ], [
                        'title' => 'New',
                        'value' => 'new',
                    ],
                    [
                        'title' => 'Random',
                        'value' => 'random',
                    ],
                ],
                'channel_based' => true
            ],
            [
                'name' => 'locations',
                'title' => 'Locations description',
                'type' => 'textarea',
                'channel_based' => true,
                'locale_based' => false,
                'default_value' =>  '[Washington D.C., USA 🇺🇸]; [Mumbai, India IN]'
            ],
        ]
    ]
];
