<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fechaCita',
        'horaCita',
        'veterinary_id',
        'pet_id',
        'descripcion',
        'notified_at',
    ];
    public function pet()
    {
    	return $this->belongsTo('App\Models\Pet');
    }
    public function veterinary()
    {
    	return $this->belongsTo('App\Models\Veterinary');
    }

    public function consulta()
    {
        return $this->hasOne('App\Models\Query');
    }

    public function scopePendingWeekend($query)
    {
        $maxEndDate = \Carbon\Carbon::now('America/Costa_Rica')->addDays(7);
         return $query->whereDate('fechaCita', '<=', $maxEndDate->format('Y-m-d'))->where('estado', 0)->orderBy('fechaCita', 'ASC')->orderBy('horaCita', 'ASC');
    }
}
