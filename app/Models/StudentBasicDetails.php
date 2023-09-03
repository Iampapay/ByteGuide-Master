<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBasicDetails extends Model
{
    use HasFactory;

    protected $table="student_basic_details";
    protected $primary_key="id";
    protected $fillable=[
        'created_by',
        's_f_name',
        's_m_name',
        's_l_name',
        'f_f_name',
        'f_m_name',
        'f_l_name',
        'm_f_name',
        'm_m_name',
        'm_l_name',
        'g_f_name',
        'g_m_name',
        'g_l_name',
        'relation_w_guard',
        'gender',
        'physically_challenged',
        'dob',
        'caste',
        'religion',
        'prf_b_slot',
        'marital_status',
        'pan_num',
        'voter_id',
        'Birth_c_no',
        'drv_lns_no',
        'x_admit_no',
        'aadhaar_no',
        'passport_no',
        'ration_c_no',
        'eco_status',
        'resid_status',
        'krdsh_id',
    ];

    public function contactDetails()
    {
        return $this->hasOne(StudentContactDetails::class, 'stud_unq_id');
    }

    public function educationDetails()
    {
        return $this->hasOne(StudentEducationDetails::class, 'stud_unq_id');
    }

    public function bankDetails()
    {
        return $this->hasOne(StudentBankDetails::class, 'stud_unq_id');
    }

    public function attachmentDetails()
    {
        return $this->hasOne(StudentAttachmentDetails::class, 'stud_unq_id');
    }

}
