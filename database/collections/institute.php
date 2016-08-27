<?php

return [
    // Profile
    
    [
        'name' => 'institute.admin.profile.index.get',
        'description' => 'Melihat profil instansi'
    ],
    [
        'name' => 'institute.admin.profile.update.put',
        'description' => 'Mengupdate profil instansi'
    ],

    // Faculties
    
    [
        'name' => 'admin.institute.faculty.index',
        'description' => 'Melihat daftar fakultas',
        'aliases' => [
            'admin.institute.faculty.datatables',
            'admin.institute.faculty.search',
            'admin.institute.faculty.show'
        ]
    ],
    [
        'name' => 'admin.institute.faculty.create',
        'description' => 'Membuat daftar fakultas baru',
        'aliases' => [
            'admin.institute.faculty.store',
            'admin.institute.faculty.restore',
        ]
    ],
    [
        'name' => 'admin.institute.faculty.edit',
        'description' => 'Mengupdate fakultas',
        'aliases' => [
            'admin.institute.faculty.update'
        ]
    ],
    [
        'name' => 'admin.institute.faculty.destroy',
        'description' => 'Menghapus fakultas',
        'aliases' => [
            'admin.institute.faculty.force-destroy'
        ]
    ],

    // Departments
    
    [
        'name' => 'admin.institute.department.index',
        'description' => 'Melihat daftar jurusan',
        'aliases' => [
            'admin.institute.department.datatables',
            'admin.institute.department.search',
            'admin.institute.department.show'
        ]
    ],
    [
        'name' => 'admin.institute.department.create',
        'description' => 'Membuat jurusan baru',
        'aliases' => [
            'admin.institute.department.store',
            'admin.institute.department.restore',
        ]
    ],
    [
        'name' => 'admin.institute.department.edit',
        'description' => 'Mengupdate jurusan',
        'aliases' => [
            'admin.institute.department.update'
        ]
    ],
    [
        'name' => 'admin.institute.department.destroy',
        'description' => 'Menghapus jurusan',
        'aliases' => [
            'admin.institute.department.force-destroy'
        ]
    ],

    // Programs
    
    [
        'name' => 'admin.institute.program.index',
        'description' => 'Melihar daftar program studi',
        'aliases' => [
            'admin.institute.program.datatables',
            'admin.institute.program.search',
            'admin.institute.program.show'
        ]
    ],
    [
        'name' => 'admin.institute.program.create',
        'description' => 'Membuat program studi',
        'aliases' => [
            'admin.institute.program.store',
            'admin.institute.program.restore',
        ]
    ],
    [
        'name' => 'admin.institute.program.edit',
        'description' => 'Mengupdate program studi',
        'aliases' => [
            'admin.institute.program.update'
        ]
    ],
    [
        'name' => 'admin.institute.program.destroy',
        'description' => 'Menghapus program studi',
        'aliases' => [
            'admin.institute.program.force-destroy'
        ]
    ],

    // Academic years
    
    [
        'name' => 'admin.institute.academic-year.index',
        'description' => 'Melihat daftar tahun ajaran',
        'aliases' => [
            'admin.institute.academic-year.datatables',
            'admin.institute.academic-year.show',
            'admin.institute.academic-year.search',
        ]
    ],
    [
        'name' => 'admin.institute.academic-year.create',
        'description' => 'Membuat tahun ajaran baru',
        'aliases' => [
            'admin.institute.academic-year.store',
            'admin.institute.academic-year.restore',
        ]
    ],
    [
        'name' => 'admin.institute.academic-year.edit',
        'description' => 'Mengupdate tahun ajaran',
        'aliases' => [
            'admin.institute.academic-year.update'
        ]
    ],
    [
        'name' => 'admin.institute.academic-year.destroy',
        'description' => 'Menghapus tahun ajaran',
        'aliases' => [
            'admin.institute.academic-year.force-destroy'
        ]
    ],
];