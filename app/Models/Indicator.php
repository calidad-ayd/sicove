<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fechaConsulta',
        'tipo',
        'valor',
    ];
    public function pet()
    {
    	return $this->belongsTo('App\Models\Pet');
    }

    public function scopeTipo($query, $tipo)
{
    return $query->where('tipo', '=', $tipo);
}
}
