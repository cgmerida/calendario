<?php

use Illuminate\Database\Seeder;

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
        $user = new User();
        $user->name = 'Gerardo';
        $user->lastname = 'Merida';
        $user->email = 'cgemerida@gmail.com';
        $user->username = 'gmerida';
        $user->password = '123456';
        $user->save();
        $user->roles()->sync(1);
    }
}
