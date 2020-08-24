<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMonitoringStatusOfMdsTable extends Migration
{
    public function up()
    {
        Schema::table('monitoring_status_of_mds', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id');
            $table->foreign('quarter_id', 'quarter_fk_1782137')->references('id')->on('reports');
            $table->unsignedInteger('point_id')->nullable();
            $table->foreign('point_id', 'point_fk_1929396')->references('id')->on('mpoints');
        });
    }
}
