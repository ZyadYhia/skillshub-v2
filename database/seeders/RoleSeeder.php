<?php

namespace Database\Seeders;

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
        $sa = Role::create(['name' => 'superadmin']);
        $a =Role::create(['name' => 'admin']);
        $s = Role::create(['name' => 'student']);
        $dashboardPermission = Permission::create(['name' => 'can enter dashboard']);
        $examPermission = Permission::create(['name' => 'can enter exam']);
        $sa->givePermissionTo([$dashboardPermission, $examPermission]);
        $a->givePermissionTo([$dashboardPermission, $examPermission]);
        $s->givePermissionTo($examPermission);
    }
}
