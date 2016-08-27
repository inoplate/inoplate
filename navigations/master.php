<?php

return [
    'master' => [
        [
            'label' => 'Wilayah',
            'url' => '',
            'order' => 0,
            'attributes' => [
                'icon'  => 'fa fa-map'
            ],
            'childs' => [
                [
                    'label' => 'Negara',
                    'url' => 'admin.master.country.index',
                    'permission' => 'admin.master.country.index',
                    'order' => 0,
                    'attributes' => [
                        'icon'  => 'fa fa-flag'
                    ],
                ],
                [
                    'label' => 'Propinsi',
                    'url' => 'admin.master.province.index',
                    'permission' => 'admin.master.province.index',
                    'order' => 1,
                    'attributes' => [
                        'icon'  => 'fa fa-map-pin'
                    ],
                ],
                [
                    'label' => 'Kab/Kota',
                    'url' => 'admin.master.district.index',
                    'permission' => 'admin.master.district.index',
                    'order' => 2,
                    'attributes' => [
                        'icon'  => 'fa fa-map-signs'
                    ],
                ],
                [
                    'label' => 'Kecamatan',
                    'url' => 'admin.master.sub-district.index',
                    'permission' => 'admin.master.sub-district.index',
                    'order' => 3,
                    'attributes' => [
                        'icon'  => 'fa fa-map-marker'
                    ],
                ],
            ]
        ],
    ],
];