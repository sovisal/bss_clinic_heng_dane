<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientLinkables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_linkables', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id')->nullable();
			$table->integer('pt_gender')->nullable();
			$table->integer('pt_age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_linkables', function (Blueprint $table) {
            //
        });
    }
}
