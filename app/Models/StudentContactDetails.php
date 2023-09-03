<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContactDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'stud_unq_id', // Add the field to the fillable array
        // other fillable fields...
    ];

}