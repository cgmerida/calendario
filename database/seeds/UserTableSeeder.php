<?php

use Illuminate\Database\Seeder;

use Calendario\Role;
use Calendario\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'Gerardo';
        $user->lastname = 'Admin';
        $user->email = 'cgemerida@gmail.com';
        $user->username = 'gmerida';
        $user->password = '123456';
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Gerardo';
        $user->lastname = 'Usuario';
        $user->email = 'gmeridaUser@gmail.com';
        $user->username = 'gmerida2';
        $user->password = '123456';
        $user->save();
        $user->roles()->attach($role_user);
    }
}
