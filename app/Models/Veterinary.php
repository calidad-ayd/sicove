<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'primerApellido',
        'segundoApellido',
        'correo',
        'telefono',
    ];
    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }  
}
