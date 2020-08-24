<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMainWorksTable extends Migration
{
    public function up()
    {
        Schema::table('main_works', function (Blueprint $table) {
            $table->unsignedInteger('quarter_id')->nullable();
            $table->foreign('quarter_id', 'quarter_fk_1928295')->references('id')->on('reports');
        });
    }
}
