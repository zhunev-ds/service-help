<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVisualInspectionOfAiisTable extends Migration
{
    public function up()
    {
        Schema::table('visual_inspection_of_aiis', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id');
            $table->foreign('quarter_id', 'quarter_fk_1782103')->references('id')->on('reports');
            $table->unsignedInteger('point_id')->nullable();
            $table->foreign('point_id', 'point_fk_1929352')->references('id')->on('mpoints');
        });
    }
}
