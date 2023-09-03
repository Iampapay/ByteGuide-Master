<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEducationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_education_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stud_unq_id')->comment('id of student_basic_details table [f_k]');
            $table->string('edu_qlf');
            $table->string('edu_qlf_status');
            $table->string('empl_status')->nullable();
            $table->string('trng_type');
            $table->string('sector');
            $table->string('course');
            $table->timestamps();
            $table->foreign('stud_unq_id')->references('id')->on('student_basic_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_education_details');
    }
}
