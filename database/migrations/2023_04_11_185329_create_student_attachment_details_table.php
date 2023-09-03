<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttachmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attachment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stud_unq_id')->comment('id of student_basic_details table [f_k]');
            $table->string('trainee_photo');
            $table->string('signature');
            $table->string('resid_proof');
            $table->string('highest_qlf_proof');
            $table->string('age_proof');
            $table->string('bank_passbook');
            $table->string('drv_lns_proof')->nullable();
            $table->string('passport_proof')->nullable();
            $table->string('ration_proof')->nullable();
            $table->string('aadhaar_proof')->nullable();
            $table->string('voter_proof')->nullable();
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
        Schema::dropIfExists('student_attachment_details');
    }
}
