<?php

return [
    'dashboard' => [
        'module_name' => 'Bảng điều khiển',
        'routes' => [
            'dashboard' => [
                'method_name' => 'Truy cập bảng điều khiển',
                'route' => 'admin.dashboard.index',
            ],
        ],
        'order' => 1
    ],



    'services' => [
        'module_name' => 'Dịch vụ',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.services.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.services.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.services.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.services.destroy',
            ],
        ],
        'order' => 3
    ],

    'galleries' => [
        'module_name' => 'Danh mục',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.galleries.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.galleries.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.galleries.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.galleries.destroy',
            ],
        ],
        'order' => 3
    ],

    'images' => [
        'module_name' => 'Hình ảnh',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.images.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.images.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.images.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.images.destroy',
            ],
        ],
        'order' => 3
    ],
    'commits' => [
        'module_name' => 'Cam kết',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.commits.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.commits.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.commits.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.commits.destroy',
            ],
        ],
    ],


    'users' => [
        'module_name' => 'Người dùng',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.users.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.users.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.users.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.users.destroy',
            ],
        ],
    ],

    'roles' => [
        'module_name' => 'Vai trò',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.roles.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.roles.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.roles.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.roles.destroy',
            ],
        ],
    ],


    'document-types' => [
        'module_name' => 'Loại tài liệu',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.document-types.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.document-types.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.document-types.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.document-types.destroy',
            ],
        ],
    ],

    'report-types' => [
        'module_name' => 'Loại báo cáo',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.report-types.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.report-types.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.report-types.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.report-types.destroy',
            ],
        ],
    ],

    'provinces' => [
        'module_name' => 'Tỉnh/Thành',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.provinces.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.provinces.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.provinces.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.provinces.destroy',
            ],
        ],
    ],

    'districts' => [
        'module_name' => 'Quận/Huyện',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.districts.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.districts.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.districts.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.districts.destroy',
            ],
        ],
    ],

    'branches' => [
        'module_name' => 'Chi nhánh',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.branches.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.branches.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.branches.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.branches.destroy',
            ],
        ],
    ],

    'company-histories' => [
        'module_name' => 'Hành trình phát triển',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.company-histories.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.company-histories.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.company-histories.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.company-histories.destroy',
            ],
        ],
    ],

    'wards' => [
        'module_name' => 'Phường/Xã',
        'routes' => [
            'index' => [
                'method_name' => 'Danh sách',
                'route' => 'admin.wards.index',
            ],
            'create' => [
                'method_name' => 'Tạo',
                'route' => 'admin.wards.create',
            ],
            'edit' => [
                'method_name' => 'Sửa',
                'route' => 'admin.wards.edit',
            ],
            'destroy' => [
                'method_name' => 'Xóa',
                'route' => 'admin.wards.destroy',
            ],
        ],
    ],
    'systems' => [
        'module_name' => 'Hệ thống',
        'routes' => [
            'generals' => [
                'method_name' => 'App',
                'route' => 'admin.systems.generals',
            ],
            'apis' => [
                'method_name' => 'APIs',
                'route' => 'admin.systems.apis',
            ],
            'shareholders' => [
                'method_name' => 'shareholder',
                'route' => 'admin.systems.config-shareholders',
            ],
            'services' => [
                'method_name' => 'Dịch vụ thứ 3',
                'route' => 'admin.systems.services',
            ],
            'socials' => [
                'method_name' => 'Mạng xã hội',
                'route' => 'admin.systems.socials',
            ],
            'otps' => [
                'method_name' => 'OTPs',
                'route' => 'admin.systems.otps',
            ],
            'notifications' => [
                'method_name' => 'Notifications',
                'route' => 'admin.systems.notifications',
            ],
            'edit' => [
                'method_name' => 'Cập nhật',
                'route' => 'admin.systems.edit',
            ]
        ],
    ],
];
