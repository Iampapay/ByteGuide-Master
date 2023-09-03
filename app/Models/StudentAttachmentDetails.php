<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttachmentDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_photo',
        'signature',
        'resid_proof',
        'product_prc',
        'highest_qlf_proof',
        'age_proof',
        'bank_passbook',
        'drv_lns_proof',
        'passport_proof',
        'ration_proof' ,
        'aadhaar_proof',
        'voter_proof',
    ];
}
