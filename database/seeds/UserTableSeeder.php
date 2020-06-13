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
        $dev_role = Role::where('slug','front-developer')->first();
        $writer_role = Role::where('slug','writer')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $admin_role = Role::where('slug', 'admin')->first();

        // ADMINISTRATOR - BIGBOSS
        $admin = User::create([
            'name' => 'Simon Pro',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123'),
        ]);
        $admin->roles()->attach($admin_role);

        // DEVELOPER
        $developer = User::create([
            'name' => 'Caleb Dev',
            'email' => 'dev@dev.com',
            'password' => bcrypt('123123'),
        ]);
        $developer->roles()->attach($dev_role);

        // MANAGER - BOSSHANDS
        $manager = User::create([
            'name' => 'Lily Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('123123'),
        ]);
        $manager->roles()->attach($manager_role);

        // WRITER
        $writer = User::create([
            'name' => 'Andrew writer',
            'email' => 'writer@writer.com',
            'password' => bcrypt('123123'),
        ]);
        $writer->roles()->attach($writer_role);
    }
}
