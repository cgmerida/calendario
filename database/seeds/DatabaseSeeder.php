<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creacion de todos los permisos
        $this->call(PermissionTableSeeder::class);

        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
    }
}
