<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisualInspectionOfAiisTable extends Migration
{
    public function up()
    {
        Schema::create('visual_inspection_of_aiis', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
