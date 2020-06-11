<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_role = Role::where('slug','developer')->first();
        $dev_perm = Permission::where('slug','create-tasks')->first();

        $manager_role = Role::where('slug', 'manager')->first();
        $manager_perm = Permission::where('slug','edit-users')->first();

        $developer = User::create([
            'name' => 'Simon Dev',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123'),
        ]);
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_perm);


        $manager = User::create([
            'name' => 'Lily Manager',
            'email' => 'test@test.com',
            'password' => bcrypt('123123'),
        ]);
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);
    }
}
