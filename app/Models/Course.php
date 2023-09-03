<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table="courses";
    protected $primary_key="id";
    protected $fillable=[
        'name',
        'academic_session_id',
        'fees',
        'fees_adv',
        'status',
    ];
}
