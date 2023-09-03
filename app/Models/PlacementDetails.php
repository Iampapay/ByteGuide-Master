<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementDetails extends Model
{
    use HasFactory;
    protected $table = 'placement_details';

    protected $fillable = [
        'job_title',
        'job_desc',
        'job_exp',
        'job_loc',
    ];
}
