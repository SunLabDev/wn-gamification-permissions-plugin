<?php return [
    'plugin' => [
        'description' => 'Allows to create and increment any measures over any model you want.'
    ],
    'permission' => [
        'label' => 'Access settings.'
    ],
    'settings' => [
        'bcp' => [
            'name' => 'Badge conditioned permissions',
            'description' => 'Attach permissions to badges',
        ],
    ],
    'fields' => [
        'badge' => 'Badge',
        'permissions' => 'Permissions',
        'permissions_desc' => "Permissions that will be granted when badge is won"
    ]
];
