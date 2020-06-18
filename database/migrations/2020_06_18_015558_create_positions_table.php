<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // create 4 position for the application..
        DB::table('positions')->insert(
            array(
                'name'=>'Training Manager',
            )
        );
        DB::table('positions')->insert(
            array(
                'name'=>'SNA Trainer',
            )
        );
        DB::table('positions')->insert(
            array(
                'name'=>'WEP Trainer',
            )
        );
        DB::table('positions')->insert(
            array(
                'name'=>'Educator',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
        
    }
}
