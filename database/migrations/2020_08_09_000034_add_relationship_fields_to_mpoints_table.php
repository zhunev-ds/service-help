<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMpointsTable extends Migration
{
    public function up()
    {
        Schema::table('mpoints', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_1928144')->references('id')->on('locations');
        });
    }
}
