<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1= Role::create(['name' => 'todolist_manager']);
        $role2= Role::create(['name' => 'todolist_user']);

        $permission1 = Permission::create(['name' => 'browse users items']);
        $permission2 = Permission::create(['name' => 'add users items']);
        $permission3 = Permission::create(['name' => 'browse items']);
        $permission4 = Permission::create(['name' => 'add items']);
        $permission5 = Permission::create(['name' => 'check items']);
        $permission6 = Permission::create(['name' => 'update items']);
        $permission7 = Permission::create(['name' => 'delete items']);

        $role1->givePermissionTo($permission1);
        $role1->givePermissionTo($permission2);

        $role2->givePermissionTo($permission3);
        $role2->givePermissionTo($permission4);
        $role2->givePermissionTo($permission5);
        $role2->givePermissionTo($permission6);
        $role2->givePermissionTo($permission7);

    }
}
