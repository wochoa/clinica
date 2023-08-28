<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;
    protected $fillable = [
        'idpaciente','tipo_cita','fecha_inicial','fecha_fin','hora_inicial','hora_fin','titulo_evento','created_at','updated_at',
    ];

    protected $primaryKey = 'idcitas';
}
