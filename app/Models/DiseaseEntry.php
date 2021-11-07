<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseEntry extends Model
{
    use HasFactory;

    public function pet()
    {
    	return $this->belongsTo('App\Models\Pet');
    }

    public function disease()
    {
    	return $this->belongsTo('App\Models\Disease');
    }

    public function treatments()
    {
    	return $this->hasMany('App\Models\Treatment');
    }

    public function activeTreatments()
    {
        return $this->hasMany('App\Models\Treatment')->ActiveTreatments();
    }

}
