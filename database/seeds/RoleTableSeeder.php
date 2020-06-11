<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_permission = Permission::where('slug','create-tasks')->first();
        $manager_permission = Permission::where('slug', 'edit-users')->first();

        $dev_role = Role::create([
            'slug' => 'developer',
            'name' => 'Front-end Developer',
        ]);
        $dev_role->permissions()->attach($dev_permission);

        $manager_role = Role::create([
            'slug' => 'manager',
            'name' => 'Assitant Manager',
        ]);
        $manager_role->permissions()->attach($manager_permission);
    }
}
