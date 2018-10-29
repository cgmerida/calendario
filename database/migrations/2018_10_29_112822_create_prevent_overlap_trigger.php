<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreventOverlapTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            "CREATE TRIGGER IF NOT EXISTS PREVENT_OVERLAP
            BEFORE INSERT ON EVENTS
            FOR EACH ROW
            BEGIN
                DECLARE N INT;
                SET N = (SELECT 1 FROM EVENTS E WHERE E.START < NEW.START AND E.END > NEW.END);
                IF N = 1 THEN
                    SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'Ya existe una actividad en este horario.';
                END IF;
            END;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER PREVENT_OVERLAP;');
    }
}
