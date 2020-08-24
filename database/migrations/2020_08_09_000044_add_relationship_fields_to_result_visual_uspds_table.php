<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResultVisualUspdsTable extends Migration
{
    public function up()
    {
        Schema::table('result_visual_uspds', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_1946671')->references('id')->on('locations');
            $table->unsignedInteger('quarter_id')->nullable();
            $table->foreign('quarter_id', 'quarter_fk_1966028')->references('id')->on('reports');
        });
    }
}
