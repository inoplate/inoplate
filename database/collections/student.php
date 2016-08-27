<?php

return [
    // Countries
    
    [
        'name' => 'admin.student.student.index',
        'description' => 'Melihat daftar mahasiswa',
        'aliases' => [
            'admin.student.student.datatables',
            'admin.student.student.show',
            'admin.student.student.search'
        ]
    ],
    [
        'name' => 'admin.student.student.create',
        'description' => 'Membuat mahasiswa baru',
        'aliases' => [
            'admin.student.student.store',
            'admin.student.student.import',
        ]
    ],
    [
        'name' => 'admin.student.student.edit',
        'description' => 'Mengupdate mahasiswa',
        'aliases' => [
            'admin.student.student.update'
        ]
    ],
    [
        'name' => 'admin.student.student.destroy',
        'description' => 'Menghapus mahasiswa',
    ],
];