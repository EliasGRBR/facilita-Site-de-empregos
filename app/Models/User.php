<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'empresa'
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
    public function curriculo()
    {
        return $this->hasOne('App\Models\Curriculo');
    }
    public function detalheEmpresa()
    {
        return $this->hasOne('App\Models\DetalhesEmpresa');
    }
    public function PublicadasVagas()
    {
        return $this->hasMany('App\Models\Vaga', 'user_id');
    }
    public function CanditaVagas()
    {
        return $this->belongsToMany('App\Models\Vaga')->withPivot('status');
    }
}
