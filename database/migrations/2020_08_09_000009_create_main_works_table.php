<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainWorksTable extends Migration
{
    public function up()
    {
        Schema::create('main_works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
