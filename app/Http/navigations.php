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
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-cube'
                    ],
                ],
                [
                    'label' => 'Fakultas',
                    'url' => 'institute.admin.faculties.index.get',
                    'order' => 1,
                    'attributes' => [
                        'icon'  => 'fa fa-paper-plane'
                    ],
                ],
                [
                    'label' => 'Jurusan',
                    'url' => 'institute.admin.departments.index.get',
                    'order' => 2,
                    'attributes' => [
                        'icon'  => 'fa fa-building'
                    ],
                ],
                [
                    'label' => 'Program studi',
                    'url' => 'institute.admin.programs.index.get',
                    'order' => 3,
                    'attributes' => [
                        'icon'  => 'fa fa-book'
                    ],
                ],
                [
                    'label' => 'Tahun ajaran',
                    'url' => 'institute.admin.academic-years.index.get',
                    'order' => 4,
                    'attributes' => [
                        'icon'  => 'fa fa-calendar-check-o'
                    ],
                ],
            ]
        ],
    ],
];