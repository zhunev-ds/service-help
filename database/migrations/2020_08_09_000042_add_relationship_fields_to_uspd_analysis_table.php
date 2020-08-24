<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUspdAnalysisTable extends Migration
{
    public function up()
    {
        Schema::table('uspd_analysis', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id')->nullable();
            $table->foreign('quarter_id', 'quarter_fk_1932309')->references('id')->on('reports');
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_1942588')->references('id')->on('locations');
        });
    }
}
