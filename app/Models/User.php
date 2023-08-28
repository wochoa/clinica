<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use LaravelPermissionToVueJS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nacionalidad',
        'tipo_doc',
        'num_doc',
        'ap_paterno',
        'ap_materno',
        'foto',
        'nombre',
        'lugar_nac',
        'sexo',
        'fecha_nac',
        'estadocivil',
        'dom_deparatmento',
        'dom_provincia',
        'dom_distrito',
        'tipo_zona',
        'nom_zona',
        'via',
        'direccion',
        'telefono',
        'celular',
        'email',
        'colegio_prof',
        'num_colegio',
        'discapcidad',
        'fuerza_arm',
        'ubigeo',
        'password',
        'adm_primer_logeo',
        'avatar',
        'darkmode',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getFullNameAttribute() // notice that the attribute name is in CamelCase.
{
    return $this->nombre . ' ' . $this->ap_paterno.' '.$this->ap_materno;
}
}
