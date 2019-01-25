<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('diagnosis_id');
            $table->unsignedInteger('encounter_id');
            $table->string('name');
            $table->string('dosage')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('provider_id')->references('id')->on('users');
            $table->foreign('diagnosis_id')->references('id')->on('diagnoses');
            $table->foreign('encounter_id')->references('id')->on('encounters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}