<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Lấy tất cả quyền từ cấu hình
        $permissions = config('permissions');

        // Lấy tất cả quyền hiện có trong cơ sở dữ liệu
        $existingPermissions = Permission::all()->keyBy('route');

        // Tạo mảng chứa các route quyền từ cấu hình
        $configuredRoutes = [];

        // Cập nhật hoặc tạo mới quyền từ cấu hình
        foreach ($permissions as $module => $moduleData) {
            foreach ($moduleData['routes'] as $method => $permission) {
                // Cập nhật hoặc tạo mới quyền
                Permission::updateOrCreate(
                    ['route' => $permission['route']],
                    [
                        'module' => $module,
                        'module_name' => $moduleData['module_name'],
                        'method' => $method,
                        'method_name' => $permission['method_name'],
                        'route' => $permission['route'],
                        // 'order' => $permission['order'] ?? 1,
                    ]
                );

                // Thêm route vào mảng các route đã cấu hình
                $configuredRoutes[] = $permission['route'];
            }
        }

        // Xóa các quyền không có trong cấu hình
        $existingPermissions->each(function ($permission) use ($configuredRoutes) {
            if (!in_array($permission->route, $configuredRoutes)) {
                $permission->delete();
            }
        });
    }
}
