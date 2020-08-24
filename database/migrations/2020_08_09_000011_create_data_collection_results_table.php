<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCollectionResultsTable extends Migration
{
    public function up()
    {
        Schema::create('data_collection_results', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->longText('change_character')->nullable();
            $table->string('considered_metrological')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
