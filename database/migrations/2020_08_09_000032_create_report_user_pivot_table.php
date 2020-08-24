<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('report_user', function (Blueprint $table) {
            $table->unsignedInteger('report_id');
            $table->foreign('report_id', 'report_id_fk_1781519')->references('id')->on('reports')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1781519')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
