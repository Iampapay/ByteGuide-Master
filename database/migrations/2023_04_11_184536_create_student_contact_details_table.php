<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_contact_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stud_unq_id')->comment('id of student_basic_details table [f_k]');;
            $table->string('house_no');
            $table->string('road_no');
            $table->string('vill_town');
            $table->string('state');
            $table->string('dist');
            $table->string('blk_mu');
            $table->string('gram_pan')->nullable();
            $table->string('post');
            $table->string('police_st');
            $table->string('pin_code');
            $table->string('email_id')->nullable();
            $table->string('pri_mbl_no');
            $table->string('sec_mbl_no')->nullable();
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
        Schema::dropIfExists('student_contact_details');
    }
}
