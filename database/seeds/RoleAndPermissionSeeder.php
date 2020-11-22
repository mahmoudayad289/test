<?php

use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = \Spatie\Permission\Models\Role::create([
            'name' => 'super_admin',
        ]);
        $role_admin = \Spatie\Permission\Models\Role::create([
            'name' => 'admin',
        ]);
        $role_user = \Spatie\Permission\Models\Role::create([
            'name' => 'user',
        ]);


        $user = \App\User::create([
           'name' => 'super_admin',
           'email' => 'super_admin@gmail.com',
           'avatar' => 'avatar.jpg',
           'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($role_super_admin);


        $permessions = [
            'create_users',
            'read_users',
            'update_users',
            'delete_users',
            'create_roles',
            'read_roles',
            'update_roles',
            'delete_roles',
            'create_categories',
            'read_categories',
            'update_categories',
            'delete_categories',
            'create_settings',
            'read_settings',
            'update_settings',
            'delete_settings',
        ];


        foreach ($permessions as $permession) {
            \Spatie\Permission\Models\Permission::create(['name' => $permession]);
        }

        $role_super_admin->syncPermissions($permessions);

    }
}
