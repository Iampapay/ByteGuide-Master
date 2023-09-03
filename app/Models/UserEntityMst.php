<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEntityMst extends Model
{
    protected $table = 'user_entity_mst';

    protected $fillable= ['entity_name', 'created_by', 'updated_by'];

    public function createdUser(){
      return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
