<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('monday_api_id');
            $table->foreign('monday_api_id')->references('id')->on('monday_apis');
            $table->string('horas_dia');
            $table->datetime('pulse_created');
            $table->datetime('pulse_updated');
            $table->timestamps();
           
            // $table->datetime('created_at');
           // $table->datetime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
