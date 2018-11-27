<?php

use Illuminate\Database\Seeder;
use Calendario\Contingency;

class ContingencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contingency::create([
            'name' => 'Mala coordinación de Alcaldías',
            'description' => 'Mala coordinación de Alcaldías Auxiliares (desinterés por coordinar con centros educativos y/o vecinos)',
        ]);
        
        Contingency::create([
            'name' => 'Condiciones climáticas',
            'description' => 'Condiciones climáticas que no permiten la realización de las diferentes actividades (lluvias, incendios entre otros)',
        ]);
        
        Contingency::create([
            'name' => 'Mala coordinación con Equipo Logístico',
            'description' => 'Mala coordinación con Equipo Logístico, no llevan los recursos para realizar las actividades (No hay toldos, sonidos, sillas para realizar el evento)',
        ]);
        
        Contingency::create([
            'name' => 'Malestar Físico o médico',
            'description' => 'Malestar Físico o médico justificable de las personas que realizaran las diversas actividades',
        ]);
        
        Contingency::create([
            'name' => 'Falta de Insumos o materiales',
            'description' => 'Falta de Insumos o materiales para la realizar las actividades',
        ]); 

        Contingency::create([
            'name' => 'Poca o nula convocatoria de vecinos',
            'description' => 'Poca o nula convocatoria de vecinos por parte de la Alcaldía Auxiliar para que asistan a las actividades',
        ]);

        Contingency::create([
            'name' => 'Alcaldía cancela actividad sin autorización',
            'description' => 'Equipo organizador de la actividad tiene contratiempo para llegar puntal a realizar la actividad y   Alcaldía Auxiliar toma decisiones sin previa autorización para cancelar las actividades',
        ]);

        Contingency::create([
            'name' => 'Ubicación no adecuada',
            'description' => 'El espacio en donde se realizará la actividad no es el adecuado (acceso complicado, poco seguro, poca iluminación etc)',
        ]);
    }
}
