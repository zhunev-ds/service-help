<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerAnalysisTable extends Migration
{
    public function up()
    {
        Schema::create('server_analysis', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
