<?php

return [
    // Countries
    
    [
        'name' => 'admin.master.country.index',
        'description' => 'Melihat daftar negara',
        'aliases' => [
            'admin.master.country.datatables',
            'admin.master.country.show',
            'admin.master.country.search'
        ]
    ],
    [
        'name' => 'admin.master.country.create',
        'description' => 'Membuat negara baru',
        'aliases' => [
            'admin.master.country.store'
        ]
    ],
    [
        'name' => 'admin.master.country.edit',
        'description' => 'Mengupdate negara',
        'aliases' => [
            'admin.master.country.update'
        ]
    ],
    [
        'name' => 'admin.master.country.destroy',
        'description' => 'Menghapus negara',
    ],


    // Province
    
    [
        'name' => 'admin.master.province.index',
        'description' => 'Melihat daftar propinsi',
        'aliases' => [
            'admin.master.province.datatables',
            'admin.master.province.show',
            'admin.master.province.search'
        ]
    ],
    [
        'name' => 'admin.master.province.create',
        'description' => 'Membuat propinsi baru',
        'aliases' => [
            'admin.master.province.store'
        ]
    ],
    [
        'name' => 'admin.master.province.edit',
        'description' => 'Mengupdate propinsi',
        'aliases' => [
            'admin.master.province.update'
        ]
    ],
    [
        'name' => 'admin.master.province.destroy',
        'description' => 'Menghapus propinsi',
    ],

    // District
    
    [
        'name' => 'admin.master.district.index',
        'description' => 'Melihat daftar kabupaten / kota',
        'aliases' => [
            'admin.master.district.datatables',
            'admin.master.district.show',
            'admin.master.district.search'
        ]
    ],
    [
        'name' => 'admin.master.district.create',
        'description' => 'Membuat kabupaten / kota baru',
        'aliases' => [
            'admin.master.district.store'
        ]
    ],
    [
        'name' => 'admin.master.district.edit',
        'description' => 'Mengupdate kabupaten / kota',
        'aliases' => [
            'admin.master.district.update'
        ]
    ],
    [
        'name' => 'admin.master.district.destroy',
        'description' => 'Menghapus kabupaten / kota',
    ],

    // Sub District
    
    [
        'name' => 'admin.master.sub-district.index',
        'description' => 'Melihat daftar kecamatan',
        'aliases' => [
            'admin.master.sub-district.datatables',
            'admin.master.sub-district.show'
        ]
    ],
    [
        'name' => 'admin.master.sub-district.create',
        'description' => 'Membuat kecamatan baru',
        'aliases' => [
            'admin.master.sub-district.store'
        ]
    ],
    [
        'name' => 'admin.master.sub-district.edit',
        'description' => 'Mengupdate kecamatan',
        'aliases' => [
            'admin.master.sub-district.update'
        ]
    ],
    [
        'name' => 'admin.master.sub-district.destroy',
        'description' => 'Menghapus kecamatan',
    ],
];