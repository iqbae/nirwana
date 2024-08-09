<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->nullable()->index('fk_doctor_to_specialist');
            $table->string('name');
            $table->string('fee');
            $table->longText('photo')->nullable();
            $table->time('monday')->nullable();
            $table->time('tuesday')->nullable();
            $table->time('wednesday')->nullable();
            $table->time('thursday')->nullable();
            $table->time('friday')->nullable();
            $table->time('saturday')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor');
    }
}
