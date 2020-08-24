<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResultVisualServersTable extends Migration
{
    public function up()
    {
        Schema::table('result_visual_servers', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id')->nullable();
            $table->foreign('quarter_id', 'quarter_fk_1966029')->references('id')->on('reports');
        });
    }
}
