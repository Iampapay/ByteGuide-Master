<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_regs', function (Blueprint $table) {
            $table->id();
            $table->string('s_f_name');
            $table->string('s_m_name');
            $table->string('s_l_name');
            $table->string('f_f_name');
            $table->string('f_m_name');
            $table->string('f_l_name');
            $table->string('m_f_name');
            $table->string('m_m_name');
            $table->string('m_l_name');
            $table->string('g_f_name');
            $table->string('g_m_name');
            $table->string('g_l_name');
            $table->string('relation_w_guard');
            $table->string('gender');
            $table->string('dob');
            $table->string('caste');
            $table->string('religion');
            $table->string('prf_b_slot');
            $table->string('marital_status');
            $table->string('pan_num');
            $table->string('voter_id');
            $table->string('Birth_c_no');
            $table->string('drv_lns_no');
            $table->string('x_admit_no');
            $table->string('aadhaar_no');
            $table->string('passport_no');
            $table->string('ration_c_no');
            $table->string('eco_status');
            $table->string('resid_status');
            $table->string('krdsh_id');
            $table->string('house_no');
            $table->string('road_no');
            $table->string('vill_town');
            $table->string('state');
            $table->string('dist');
            $table->string('blk_mu');
            $table->string('gram_pan');
            $table->string('post');
            $table->string('police_st');
            $table->string('pin_code');
            $table->string('email_id');
            $table->string('pri_mbl_no');
            $table->string('sec_mbl_no');
            $table->string('edu_qlf');
            $table->string('edu_qlf_status');
            $table->string('empl_status');
            $table->string('trng_type');
            $table->string('sector');
            $table->string('course');
            $table->string('ifs_code');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('acc_no');
            $table->string('acc_hol_f_name');
            $table->string('trainee_photo');
            $table->string('signature');
            $table->string('resid_proof');
            $table->string('highest_qlf_proof');
            $table->string('age_proof');
            $table->string('bank_passbook');
            $table->string('drv_lns_proof');
            $table->string('passport_proof');
            $table->string('ration_proof');
            $table->string('aadhaar_proof');
            $table->string('voter_proof');
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
        Schema::dropIfExists('student_regs');
    }
}
