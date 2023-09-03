<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_bank_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stud_unq_id')->comment('id of student_basic_details table [f_k]');
            $table->string('ifs_code');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('acc_no');
            $table->string('acc_hol_f_name');
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
        Schema::dropIfExists('student_bank_details');
    }
}
