<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedInteger('responsible_id')->nullable();
            $table->foreign('responsible_id', 'responsible_fk_1781518')->references('id')->on('users');
        });
    }
}
