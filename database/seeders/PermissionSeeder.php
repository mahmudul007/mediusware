<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin = Role::create(['name' => 'admin']);

        $user = Role::create(['name' => 'user']);
        // Create Permissions

        $permissions = [

            ['id' => 1, 'name' => 'account_create'],
            ['id' => 2, 'name' => 'transaction_approve'],
            ['id' => 3, 'name' => 'view_all_account'],
            ['id' => 4, 'name' => 'view_my_transaction_history'],
          
           

        ];
        // Assign Permissions to Role
        foreach ($permissions as $item) {
            Permission::create($item);
        }
        $userPermission = [4];
        $admin->syncPermissions(Permission::all());
        $user->syncPermissions(Permission::whereIn('id', $userPermission)->get());

        $this->enableForeignKeys();

    }
}
