<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchSlot extends Model
{
    use HasFactory;

    protected $table = 'batch_slots';

    protected $fillable = [
        'start_time',
        'end_time',
    ];
}
