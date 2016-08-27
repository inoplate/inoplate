<?php

return [
    'plugin' => [
        [
            'label' => 'Kemahasiswaan',
            'url' => '',
            'order' => 0,
            'attributes' => [
                'icon'  => 'fa fa-laptop'
            ],
            'childs' => [
                [
                    'label' => 'Mahasiswa',
                    'url' => 'admin.student.student.index',
                    'permission' => 'admin.student.student.index',
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-graduation-cap'
                    ],
                ],
            ]
        ],
    ],
];