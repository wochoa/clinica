<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'idpaciente','diagnostico','costo_total','adelanto','data_odontograma','created_at','updated_at',
    ];

    protected $primaryKey = 'idtratamientos';
}
