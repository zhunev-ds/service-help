<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiisDataCompletenessesTable extends Migration
{
    public function up()
    {
        Schema::create('aiis_data_completenesses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('state')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
