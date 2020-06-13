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
        /**
         * * Roles creation
         */
        $adminRole = Role::create([
            'slug' => 'admin',
            'name' => 'Administrator',
        ]);
        $managerRole = Role::create([
            'slug' => 'manager',
            'name' => 'Assistant Manager',
        ]);
        $devFrontRole = Role::create([
            'slug' => 'front-developer',
            'name' => 'Front-end Developer',
        ]);
        $writerRole = Role::create([
            'slug' => 'writer',
            'name' => 'Blog writer',
        ]);

        /**
         * * Permissions creation
         */
        $editUsers = Permission::create([
            'slug' => 'edit-users',
            'name' => 'Edit Users',
        ]);
        $createTasks = Permission::create([
            'slug' => 'create-tasks',
            'name' => 'Create Tasks',
        ]);
        $createPosts = Permission::create([
            'slug' => 'create-posts',
            'name' => 'Create Posts',
        ]);
        $editPosts = Permission::create([
            'slug' => 'edit-posts',
            'name' => 'Edit Posts',
        ]);

        /**
         * * Relations between roles and permissions
         */
        $managerRole->permissions()->attach($editUsers);
        $devFrontRole->permissions()->attach($createTasks);
        $writerRole->permissions()->attach($createPosts);
        $writerRole->permissions()->attach($editPosts);

        // Always at the end of seeder
    }
}
