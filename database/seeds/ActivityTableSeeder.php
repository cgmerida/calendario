<?php

use Calendario\Unity;
use Flynsarmy\CsvSeeder\CsvSeeder;

class ActivityTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'activities';
        $this->filename = base_path() . '/database/seeds/csvs/actividades.csv';
        $this->csv_delimiter = ';';
        $this->timestamps = true;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
    }

    public function insert(array $seedData)
    {
        if ($this->timestamps) {
            $new = [];
            foreach ($seedData as $key => $item) {
                $new[$key] = $item;
                $unity = Unity::where('name', '=', $new[$key]['unity_id'])->first();
                if (!$unity) {
                    $unity = Unity::create(['name' => $new[$key]['unity_id']]);
                }
                $new[$key]['unity_id'] = $unity->id;
                $new[$key]['created_at'] = \Carbon\Carbon::now();
                $new[$key]['updated_at'] = \Carbon\Carbon::now();
            }
            $seedData = $new;
        }

        try {
            DB::table($this->table)->insert($seedData);
        } catch (\Exception $e) {
            Log::error("CSV insert failed: " . $e->getMessage() . " - CSV " . $this->filename);
            return false;
        }
        return true;
    }
}
