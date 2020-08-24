<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultVisualUspdsTable extends Migration
{
    public function up()
    {
        Schema::create('result_visual_uspds', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
