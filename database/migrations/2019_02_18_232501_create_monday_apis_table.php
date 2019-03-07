<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMondayApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monday_apis', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('member');
            $table->integer('pulse_id');
            $table->string('pulse_name');
            $table->string('pulse_status');
            $table->string('pulse_category');
            $table->string('pulse_timetrack');
            $table->datetime('pulse_created');
            $table->datetime('pulse_updated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monday_apis');
    }
}
