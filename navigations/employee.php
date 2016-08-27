<?php

return [
    'plugin' => [
        [
            'label' => 'Kepegawaian',
            'url' => '',
            'order' => 0,
            'attributes' => [
                'icon'  => 'fa fa-fax'
            ],
            'childs' => [
                [
                    'label' => 'Dosen',
                    'url' => 'admin.employee.lecturer.index',
                    'permission' => 'admin.employee.lecturer.index',
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-briefcase'
                    ],
                ],
            ]
        ],
    ],
];