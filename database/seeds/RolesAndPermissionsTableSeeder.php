<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Create Role
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Người quản trị',
            'description' => 'Quản lý toàn hệ thống'
        ]);

        $writer = Role::create([
            'name' => 'writer',
            'display_name' => 'Biên tập viên',
            'description' => 'Đăng các bài viết cho website'
        ]);

        $seller = Role::create([
            'name' => 'seller',
            'display_name' => 'Nhân viên kinh doanh',
            'description' => 'Quản lý việc đặt hàng và giao hàng đến cho khách hàng'
        ]);

        $customer = Role::create([
            'name' => 'customer',
            'display_name' => 'Khách hàng',
            'description' => ''
        ]);

//        Create Permission
        $listUsers = Permission::create([
            'name' => 'list-users',
            'display_name' => 'Danh sách thành viên',
            'description' => ''
        ]);

        $createUser = Permission::create([
            'name' => 'create-user',
            'display_name' => 'Tạo thành viên',
            'description' => ''
        ]);

        $editUser = Permission::create([
            'name' => 'edit-user',
            'display_name' => 'Cập nhật thông tin thành viên',
            'description' => ''
        ]);

        $deleteUser = Permission::create([
            'name' => 'delete-user',
            'display_name' => 'Xoá thành viên',
            'description' => ''
        ]);

        $uploadImages = Permission::create([
            'name' => 'upload-images',
            'display_name' => 'Tải lên hình ảnh',
            'description' => ''
        ]);

//        Assign Roles with Permisions
//        $admin->perms()->attach([$createUser->id, $editUser->id, $deleteUser->id]);
        $admin->perms()->attach($listUsers);
        $admin->perms()->attach($createUser);
        $admin->perms()->attach($editUser);
        $admin->perms()->attach($deleteUser);
        $admin->perms()->attach($uploadImages);

        $writer->perms()->attach($createUser);

//        $user = User::find(1);
//        $user->attachRole($admin);
//
//        $user = User::find(2);
//        $user->attachRole($writer);
//
//        $user = User::find(3);
//        $user->attachRole($seller);
    }
}
