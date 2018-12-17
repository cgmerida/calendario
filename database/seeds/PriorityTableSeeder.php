<?php

use Illuminate\Database\Seeder;
use Calendario\Priority;

class PriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create([
            'name' => 'Prioridad 1',
            'color' => '#b1a0c7',
            'textColor' => '#000'
        ]);
        
        Priority::create([
            'name' => 'Prioridad 2',
            'color' => '#b8cce4',
            'textColor' => '#000'
        ]);
        
        Priority::create([
            'name' => 'Prioridad 3',
            'color' => '#002060',
            'textColor' => '#fff'
        ]);
        
        Priority::create([
            'name' => 'Prioridad 4',
            'color' => '#fabf8f',
            'textColor' => '#000'
        ]);
        
        Priority::create([
            'name' => 'Prioridad 5',
            'color' => '#bfbfbf',
            'textColor' => '#000'
        ]);
    }
}
