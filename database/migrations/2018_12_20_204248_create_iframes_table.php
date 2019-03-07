<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIframesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iframes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iframeid')->unique();
            $table->longText('iframe');
            $table->timestamps();
            $table->string('keyframe');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iframes');
    }
}
