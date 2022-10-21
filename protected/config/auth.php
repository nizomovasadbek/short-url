<?php

return [
    'guest' => [
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'guest',
        'bizRule' => null,
        'data' => null
    ],
    'user' => [
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => [
            'guest'
        ],
        'bizRule' => null,
        'data' => null
    ],
    'admin' => [
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Admin',
        'children' => [
            'user',
            'guest'
        ],
        'bizRule' => null,
        'data' => null
    ]
];
