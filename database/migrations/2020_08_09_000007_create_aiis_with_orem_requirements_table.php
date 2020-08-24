<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiisWithOremRequirementsTable extends Migration
{
    public function up()
    {
        Schema::create('aiis_with_orem_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->string('state_p_313')->nullable();
            $table->string('state_p_314')->nullable();
            $table->string('state_p_315')->nullable();
            $table->string('state_pf_2')->nullable();
            $table->string('state_pf_4')->nullable();
            $table->string('state_pf_7')->nullable();
            $table->string('state_pf_8')->nullable();
            $table->string('state_pf_9')->nullable();
            $table->string('state_pf_10')->nullable();
            $table->string('state_pf_11')->nullable();
            $table->string('state_pf_13')->nullable();
            $table->string('state_pf_16')->nullable();
            $table->string('state_pf_24')->nullable();
            $table->string('state_pf_28')->nullable();
            $table->string('state_pf_32')->nullable();
            $table->string('state_pf_40')->nullable();
            $table->string('state_pf_41')->nullable();
            $table->string('state_pf_42')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
