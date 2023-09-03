<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterEmployeer extends Model
{
    use HasFactory;
    protected $table = 'register_employeers';

    protected $fillable = [
        'comp_name',
        'comp_address',
        'comp_logo',
    ];
}
