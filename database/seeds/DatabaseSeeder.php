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

        //Creacion de todas las contingencias
        $this->call(ContingencyTableSeeder::class);
        
        //Creacion de todas las colonias
        $this->call(ColonyTableSeeder::class);

        //Creacion de los privilegios
        $this->call(PriorityTableSeeder::class);

        //Creacion de las unidades con privilegios
        $this->call(UnitiesTableSeeder::class);

        //Creacion de todas las actividades y unidades ejecutoras
        $this->call(ActivityTableSeeder::class);

        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
    }
}
