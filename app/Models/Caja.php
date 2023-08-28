<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $fillable = [
        'idcaja','fecha','tit_caja','medio_pago','tipo_caja','monto_caja','created_at','updated_at',
    ];

    protected $primaryKey = 'idcaja';
}
