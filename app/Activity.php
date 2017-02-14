<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = true;
    protected $fillable = ['name', 'type', 'description', 'area', 'expiry', 'completed', 'user_id'];
}
