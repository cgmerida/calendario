<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ColonyTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'colonies';
        $this->filename = base_path() . '/database/seeds/csvs/colonias.csv';
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
        // Recommended when importing larger CSVs
        // DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();
    }
}
