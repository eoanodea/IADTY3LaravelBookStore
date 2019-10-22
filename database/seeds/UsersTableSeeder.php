<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        $admin = new User ();
        $admin->name = 'Mo Che';
        $admin->email = 'testadmin@test.ie';
        $admin->password = bcrypt('testtest');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $user = new User ();
        $user->name = 'Mo Che';
        $user->email = 'testuser@test.ie';
        $user->password = bcrypt('testtest');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
