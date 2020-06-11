<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_role = Role::where('slug','developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();

        $createTasks = Permission::create([
            'slug' => 'create-tasks',
            'name' => 'Create Tasks',
        ]);
        $createTasks->roles()->attach($dev_role);

        $editUsers = Permission::create([
            'slug' => 'edit-users',
            'name' => 'Edit Users',
        ]);
        $editUsers->roles()->attach($manager_role);
    }
}
