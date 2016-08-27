<?php

return [
    'plugin' => [
        [
            'label' => 'Instansi',
            'url' => '',
            'order' => 0,
            'attributes' => [
                'icon'  => 'fa fa-bank'
            ],
            'childs' => [
                [
                    'label' => 'Profil instansi',
                    'url' => 'institute.admin.profile.index.get',
                    'permission' => 'institute.admin.profile.index.get',
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-cube'
                    ],
                ],
                [
                    'label' => 'Fakultas',
                    'url' => 'admin.institute.faculty.index',
                    'permission' => 'admin.institute.faculty.index',
                    'order' => 1,
                    'attributes' => [
                        'icon'  => 'fa fa-paper-plane'
                    ],
                ],
                [
                    'label' => 'Jurusan',
                    'url' => 'admin.institute.department.index',
                    'permission' => 'admin.institute.department.index',
                    'order' => 2,
                    'attributes' => [
                        'icon'  => 'fa fa-building'
                    ],
                ],
                [
                    'label' => 'Program studi',
                    'url' => 'admin.institute.program.index',
                    'permission' => 'admin.institute.program.index',
                    'order' => 3,
                    'attributes' => [
                        'icon'  => 'fa fa-book'
                    ],
                ],
                [
                    'label' => 'Periode akademik',
                    'url' => 'admin.institute.academic-year.index',
                    'permission' => 'admin.institute.academic-year.index',
                    'order' => 4,
                    'attributes' => [
                        'icon'  => 'fa fa-calendar-check-o'
                    ],
                ],
            ]
        ],
    ],
];