<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineEntry extends Model
{
    use HasFactory;

    public function pet()
    {
    	return $this->belongsTo('App\Models\Pet');
    }

    public function vaccine()
    {
    	return $this->belongsTo('App\Models\Vaccine');
    }

}
