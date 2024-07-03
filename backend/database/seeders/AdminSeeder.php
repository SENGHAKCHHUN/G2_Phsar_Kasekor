<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);



        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'user']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'Category access']);
        $permission = Permission::create(['name' => 'Category edit']);
        $permission = Permission::create(['name' => 'Category create']);
        $permission = Permission::create(['name' => 'Category delete']);

        $permission = Permission::create(['name' => 'Product access']);
        $permission = Permission::create(['name' => 'Product edit']);
        $permission = Permission::create(['name' => 'Product create']);
        $permission = Permission::create(['name' => 'Product delete']);

        $permission = Permission::create(['name' => 'Address access']);
        $permission = Permission::create(['name' => 'Address edit']);
        $permission = Permission::create(['name' => 'Address create']);
        $permission = Permission::create(['name' => 'Address delete']);

        $permission = Permission::create(['name' => 'Comment access']);
        $permission = Permission::create(['name' => 'Comment edit']);
        $permission = Permission::create(['name' => 'Comment create']);
        $permission = Permission::create(['name' => 'Comment delete']);

        $permission = Permission::create(['name' => 'Shop access']);
        $permission = Permission::create(['name' => 'Shop edit']);
        $permission = Permission::create(['name' => 'Shop create']);
        $permission = Permission::create(['name' => 'Shop delete']);

        $permission = Permission::create(['name' => 'StockLimit access']);
        $permission = Permission::create(['name' => 'StockLimit edit']);
        $permission = Permission::create(['name' => 'StockLimit create']);
        $permission = Permission::create(['name' => 'StockLimit delete']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);

        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);
        $admin_role->givePermissionTo(Permission::all());
    }
}
