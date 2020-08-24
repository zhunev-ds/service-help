<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringStatusOfMdsTable extends Migration
{
    public function up()
    {
        Schema::create('monitoring_status_of_mds', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
