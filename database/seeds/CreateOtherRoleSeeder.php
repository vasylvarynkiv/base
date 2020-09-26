<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateOtherRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Creator']);
        $permissions = Permission::whereIn('name', ['user-list', 'user-create'])->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'Moderator']);
        $permissions = Permission::whereIn('name', ['user-list', 'user-edit'])->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
    }
}
