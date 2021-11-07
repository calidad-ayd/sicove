<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

        public function diseaseEntry()
    {
    	return $this->belongsTo('App\Models\DiseaseEntry');
    }
    public function advances()
    {
        return $this->hasMany('App\Models\Advance');
    }

    public function scopeActiveTreatments($query)
    {
        $maxEndDate = \Carbon\Carbon::now('America/Costa_Rica');
         return $query->whereDate('finalizacion', '>=', $maxEndDate->format('Y-m-d'))->orderBy('finalizacion', 'ASC');
    }
}
