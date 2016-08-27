<?php

return [
    // Countries
    
    [
        'name' => 'admin.academic.subject.index',
        'description' => 'Melihat daftar mata kuliah',
        'aliases' => [
            'admin.academic.subject.datatables',
            'admin.academic.subject.show',
            'admin.academic.subject.search'
        ]
    ],
    [
        'name' => 'admin.academic.subject.create',
        'description' => 'Membuat mata kuliah baru',
        'aliases' => [
            'admin.academic.subject.store'
        ]
    ],
    [
        'name' => 'admin.academic.subject.edit',
        'description' => 'Mengupdate mata kuliah',
        'aliases' => [
            'admin.academic.subject.update'
        ]
    ],
    [
        'name' => 'admin.academic.subject.destroy',
        'description' => 'Menghapus mata kuliah',
    ],

    // Classes
    [
        'name' => 'admin.academic.class.index',
        'description' => 'Melihat daftar kelas',
        'aliases' => [
            'admin.academic.class.datatables',
            'admin.academic.class.show',
            'admin.academic.class.search'
        ]
    ],
    [
        'name' => 'admin.academic.class.create',
        'description' => 'Membuat kelas baru',
        'aliases' => [
            'admin.academic.class.store'
        ]
    ],
    [
        'name' => 'admin.academic.class.edit',
        'description' => 'Mengupdate kelas',
        'aliases' => [
            'admin.academic.class.update'
        ]
    ],
    [
        'name' => 'admin.academic.class.destroy',
        'description' => 'Menghapus kelas',
    ],

    // Study plan

    [
        'name' => 'admin.academic.study-plan.index',
        'description' => 'Melihat seluruh kelas mahasiswa',
        'aliases' => [
            'admin.academic.study-plan.assigned-student',
            'admin.academic.study-plan.unassigned-student',
        ]
    ],

    [
        'name' => 'admin.academic.study-plan.map',
        'description' => 'Memngatur kelas mahasiswa',
    ],
];