<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //USERS
        Permission::create([
            'name' => 'Navegar usuarios',
            'slug' => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de usuarios',
            'slug' => 'users.create',
            'description' => 'Crea nuevos usuarios para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de usuario',
            'slug' => 'users.show',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de usuario',
            'slug' => 'users.edit',
            'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'users.destroy',
            'description' => 'Eliminar cualquier usuario del sistema',
        ]);

        //ROLES
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de roles',
            'slug' => 'roles.create',
            'description' => 'Crea nuevos roles para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de rol',
            'slug' => 'roles.show',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de rol',
            'slug' => 'roles.edit',
            'description' => 'Editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar rol',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar cualquier rol del sistema',
        ]);

        //CONTINGENCY
        Permission::create([
            'name' => 'Navegar contingencias',
            'slug' => 'contingencies.index',
            'description' => 'Lista y navega todos los contingencias del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de contingencias',
            'slug' => 'contingencies.create',
            'description' => 'Crea nuevos contingencias para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de contingencia',
            'slug' => 'contingencies.show',
            'description' => 'Lista y navega todos los contingencias del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de contingencia',
            'slug' => 'contingencies.edit',
            'description' => 'Editar cualquier dato de un contingencia del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar contingencia',
            'slug' => 'contingencies.destroy',
            'description' => 'Eliminar cualquier contingencia del sistema',
        ]);

        //PRIORITY
        Permission::create([
            'name' => 'Navegar prioridades',
            'slug' => 'priorities.index',
            'description' => 'Lista y navega todos los prioridades del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de prioridades',
            'slug' => 'priorities.create',
            'description' => 'Crea nuevos prioridades para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de prioridad',
            'slug' => 'priorities.show',
            'description' => 'Lista y navega todos los prioridades del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de prioridad',
            'slug' => 'priorities.edit',
            'description' => 'Editar cualquier dato de un prioridad del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar prioridad',
            'slug' => 'priorities.destroy',
            'description' => 'Eliminar cualquier prioridad del sistema',
        ]);

        //UNITY
        Permission::create([
            'name' => 'Navegar unidades',
            'slug' => 'unities.index',
            'description' => 'Lista y navega todos los unidades del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de unidades',
            'slug' => 'unities.create',
            'description' => 'Crea nuevos unidades para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de unidad',
            'slug' => 'unities.show',
            'description' => 'Lista y navega todos los unidades del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de unidad',
            'slug' => 'unities.edit',
            'description' => 'Editar cualquier dato de un unidad del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar unidad',
            'slug' => 'unities.destroy',
            'description' => 'Eliminar cualquier unidad del sistema',
        ]);

        //ACTIVITY
        Permission::create([
            'name' => 'Navegar actividades',
            'slug' => 'activities.index',
            'description' => 'Lista y navega todos los actividades del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de actividades',
            'slug' => 'activities.create',
            'description' => 'Crea nuevos actividades para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de actividad',
            'slug' => 'activities.show',
            'description' => 'Lista y navega todos los actividades del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de actividad',
            'slug' => 'activities.edit',
            'description' => 'Editar cualquier dato de un actividad del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar actividad',
            'slug' => 'activities.destroy',
            'description' => 'Eliminar cualquier actividad del sistema',
        ]);

        //COLONY
        Permission::create([
            'name' => 'Navegar colonias',
            'slug' => 'colonies.index',
            'description' => 'Lista y navega todas las colonias del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de colonias',
            'slug' => 'colonies.create',
            'description' => 'Crea nuevos colonias para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de colonia',
            'slug' => 'colonies.show',
            'description' => 'Lista y navega todos los colonias del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de colonia',
            'slug' => 'colonies.edit',
            'description' => 'Editar cualquier dato de un colonia del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar colonia',
            'slug' => 'colonies.destroy',
            'description' => 'Eliminar cualquier colonia del sistema',
        ]);
        
        //EVENTS
        Permission::create([
            'name' => 'Navegar eventos',
            'slug' => 'events.index',
            'description' => 'Lista y navega todos los eventos del sistema',
        ]);

        Permission::create([
            'name' => 'Creación de eventos',
            'slug' => 'events.create',
            'description' => 'Crea nuevos eventos para el sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de evento',
            'slug' => 'events.show',
            'description' => 'Lista y navega todos los eventos del sistema',
        ]);

        Permission::create([
            'name' => 'Edición de evento',
            'slug' => 'events.edit',
            'description' => 'Editar cualquier dato de un evento del sistema',
        ]);

        Permission::create([
            'name' => 'Cerrar evento',
            'slug' => 'events.close',
            'description' => 'Cierra los eventos en el sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar evento',
            'slug' => 'events.destroy',
            'description' => 'Eliminar cualquier evento del sistema',
        ]);


        //CALENDAR
        Permission::create([
            'name' => 'Calendario de Visualización',
            'slug' => 'calendar.show',
            'description' => 'Vista del calendario',
        ]);
        
        Permission::create([
            'name' => 'Calendario de Logistica',
            'slug' => 'calendar.logistics',
            'description' => 'Vista del calendario',
        ]);
        

    }
}
