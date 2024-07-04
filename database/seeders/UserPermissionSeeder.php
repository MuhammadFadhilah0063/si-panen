<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'admin-access']);
        Permission::create(['name' => 'petani-access']);
        Permission::create(['name' => 'penyuluh-access']);
        Permission::create(['name' => 'kabid-access']);
        Permission::create(['name' => 'pegawai-access']);

        $super_admin_role = Role::create(['name' => 'super-admin']);
        $super_admin_role->givePermissionTo('admin-access');
        $super_admin_role->givePermissionTo('petani-access');
        $super_admin_role->givePermissionTo('penyuluh-access');
        $super_admin_role->givePermissionTo('kabid-access');
        $super_admin_role->givePermissionTo('pegawai-access');

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo('admin-access');

        $petani_role = Role::create(['name' => 'petani']);
        $petani_role->givePermissionTo('petani-access');

        $penyuluh_role = Role::create(['name' => 'penyuluh']);
        $penyuluh_role->givePermissionTo('penyuluh-access');

        $kabid_role = Role::create(['name' => 'kabid']);
        $kabid_role->givePermissionTo('kabid-access');

        $pegawai_role = Role::create(['name' => 'pegawai']);
        $pegawai_role->givePermissionTo('pegawai-access');


        $users = User::all();

        foreach ($users as $user) {
            if ($user->id == 1) {
                $user->assignRole($admin_role);
            } else if ($user->id == 2) {
                $user->assignRole($penyuluh_role);
            } else if ($user->id == 3) {
                $user->assignRole($petani_role);
            } else if ($user->id == 4) {
                $user->assignRole($kabid_role);
            }
        }
    }
}
