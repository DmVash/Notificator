<?php
return [
    'viewNotice' => [
        'type' => 2,
        'description' => 'View notice',
    ],
    'createNotice' => [
        'type' => 2,
        'description' => 'Create notice',
    ],
    'updateNotice' => [
        'type' => 2,
        'description' => 'Update notice',
    ],
    'deleteNotice' => [
        'type' => 2,
        'description' => 'Delete notice',
    ],
    'viewUsers' => [
        'type' => 2,
        'description' => 'View users',
    ],
    'banUser' => [
        'type' => 2,
        'description' => 'Ban user',
    ],
    'createPost' => [
        'type' => 2,
        'description' => 'Create post',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'viewNotice',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'user',
            'createNotice',
            'updateNotice',
            'deleteNotice',
            'viewUsers',
            'banUser',
            'createPost',
        ],
    ],
];
