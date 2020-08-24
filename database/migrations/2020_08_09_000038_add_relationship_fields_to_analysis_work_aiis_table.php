<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAnalysisWorkAiisTable extends Migration
{
    public function up()
    {
        Schema::table('analysis_work_aiis', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id')->nullable();
            $table->foreign('quarter_id', 'quarter_fk_1919048')->references('id')->on('reports');
        });
    }
}
