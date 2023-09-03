<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBasicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_basic_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->string('s_f_name');
            $table->string('s_m_name')->nullable();
            $table->string('s_l_name');
            $table->string('f_f_name');
            $table->string('f_m_name')->nullable();
            $table->string('f_l_name');
            $table->string('m_f_name');
            $table->string('m_m_name')->nullable();
            $table->string('m_l_name');
            $table->string('g_f_name')->nullable();
            $table->string('g_m_name')->nullable();
            $table->string('g_l_name')->nullable();
            $table->string('relation_w_guard');
            $table->string('gender');
            $table->string('physically_challenged');
            $table->string('dob');
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('prf_b_slot')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('pan_num')->nullable();
            $table->string('voter_id')->nullable();
            $table->string('Birth_c_no')->nullable();
            $table->string('drv_lns_no')->nullable();
            $table->string('x_admit_no')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('ration_c_no')->nullable();
            $table->string('eco_status');
            $table->string('resid_status');
            $table->string('krdsh_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_basic_details');
    }
}
