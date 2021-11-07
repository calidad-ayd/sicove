<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

        public function treatment()
    {
    	return $this->belongsTo('App\Models\Treatment');
    }

}
