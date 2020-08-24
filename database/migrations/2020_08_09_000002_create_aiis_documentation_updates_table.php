<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiisDocumentationUpdatesTable extends Migration
{
    public function up()
    {
        Schema::create('aiis_documentation_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year')->nullable();
            $table->longText('actual_metr_data')->nullable();
            $table->longText('mapping')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
