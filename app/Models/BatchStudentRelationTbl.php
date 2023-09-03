<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchStudentRelationTbl extends Model
{
    use HasFactory;
    protected $table="batch_student_relation_tbls";
    protected $primary_key="id";
    protected $fillable=[
        'batch_id',
        'student_id'
    ];
}
