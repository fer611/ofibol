<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;  // Importando el trait de spatie permissions

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'rol_id',
        'estado',
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
        'password' => 'hashed',
    ];

    public function adminlte_desc()
    {
        return 'aqui puedes mostrar el correo electronico';
    }
    public function adminlte_image()
    {
        /* Aca podemos poner la imagen del usuario */
        return 'storage/logo.png';
    }
    public function adminlte_profile_url()
    {
        /* aca redireccionamos al enlace de perfil */
        return 'profile';
    }

    //si dice rol espera rol_id
    public function rol()
    {
        //pertenece a
        return $this->belongsTo(Rol::class);
    }
}
