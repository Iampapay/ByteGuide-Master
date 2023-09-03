<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $table="courses";
    protected $primary_key="id";
    protected $fillable = [
        'course_name',
        'course_code',
    ];
}
