<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultVisualServersTable extends Migration
{
    public function up()
    {
        Schema::create('result_visual_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('resut')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
