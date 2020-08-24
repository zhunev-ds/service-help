<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToServerAnalysisTable extends Migration
{
    public function up()
    {
        Schema::table('server_analysis', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id')->nullable();
            $table->foreign('quarter_id', 'quarter_fk_1932306')->references('id')->on('reports');
        });
    }
}
