<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sa = Role::create(['name' => RolesEnum::SUPERADMIN]);
        $a = Role::create(['name' => RolesEnum::ADMIN]);
        $s = Role::create(['name' => RolesEnum::STUDENT]);

        $dashboardPermission = Permission::create(['name' => PermissionsEnum::CAN_ENTER_DASHBOARD]);
        $examPermission = Permission::create(['name' => PermissionsEnum::CAN_ENTER_EXAM]);
        
        $sa->givePermissionTo([$dashboardPermission, $examPermission]);
        $a->givePermissionTo([$dashboardPermission, $examPermission]);
        $s->givePermissionTo($examPermission);
    }
}
