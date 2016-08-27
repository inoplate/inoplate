<?php

return [
    'plugin' => [
        [
            'label' => 'Akademik',
            'url' => '',
            'order' => 0,
            'attributes' => [
                'icon'  => 'fa fa-star'
            ],
            'childs' => [
                [
                    'label' => 'Kelas mahasiswa',
                    'url' => 'admin.academic.study-plan.index',
                    'permission' => 'admin.academic.study-plan.index',
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-street-view'
                    ],
                ],
                [
                    'label' => 'Kelas',
                    'url' => 'admin.academic.class.index',
                    'permission' => 'admin.academic.class.index',
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-thumb-tack'
                    ],
                ],
                [
                    'label' => 'Mata kuliah',
                    'url' => 'admin.academic.subject.index',
                    'permission' => 'admin.academic.subject.index',
                    'order' => 1,
                    'attributes' => [
                        'icon'  => 'fa fa-book'
                    ],
                ],
            ]
        ],
    ],
];