<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public $timestamps = true;
    protected $fillable = ['name', 'type', 'description', 'expiry', 'completed', 'user_id'];
}
