<?php

return [
    // Countries
    
    [
        'name' => 'admin.employee.lecturer.index',
        'description' => 'Melihat daftar dosen',
        'aliases' => [
            'admin.employee.lecturer.datatables',
            'admin.employee.lecturer.show',
            'admin.employee.lecturer.search'
        ]
    ],
    [
        'name' => 'admin.employee.lecturer.create',
        'description' => 'Membuat dosen baru',
        'aliases' => [
            'admin.employee.lecturer.store',
            'admin.employee.lecturer.import',
        ]
    ],
    [
        'name' => 'admin.employee.lecturer.edit',
        'description' => 'Mengupdate dosen',
        'aliases' => [
            'admin.employee.lecturer.update'
        ]
    ],
    [
        'name' => 'admin.employee.lecturer.destroy',
        'description' => 'Menghapus dosen',
    ],
];