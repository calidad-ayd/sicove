<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'tipoDeAnimal',
        'raza',
        'fechaNacimiento',
        'foto',
        'client_id',
    ];

    public function getAgeAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->fechaNacimiento, 'America/Costa_Rica')->diff(Carbon::now())->format('%y años y %m meses');
    }

    public function diseases()
    {
        return $this->hasMany('App\Models\DiseaseEntry');
    }   

    public function indicators()
    {
        return $this->hasMany('App\Models\Indicator');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }  

     public function vaccines()
    {
        return $this->hasMany('App\Models\VaccineEntry');
    }
    public function client()
    {
    	return $this->belongsTo('App\Models\Client');
    }

    public function queries()
    {
        return $this->hasMany('App\Models\Query');
    }

    public function eventsPending()
    {
        return $this->hasMany('App\Models\Event')->PendingWeekend();
    }

    public function treatments()
    {
        return $this->hasMany('App\Models\DiseaseEntry');
    }
}
