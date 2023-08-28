<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $fillable = [
        'tit_diagnostico','text_diagnostico','pago_adelanto','h_odontograma','idtratamiento','created_at','updated_at',
    ];

    protected $primaryKey = 'idhistorial';
}
