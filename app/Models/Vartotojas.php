<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vartotojas extends Authenticatable
{
    protected $table = 'vartotojai';

    use HasFactory, Notifiable;

    const CREATED_AT = 'data_sukurta';
    const UPDATED_AT = 'data_atnaujinta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vardas',
        'pavarde',
        'email',
        'password',
        'adresas',
        'miestas',
        'salis',
        'pasto_kodas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pakvietimas()
    {
        return $this->hasOne(Pakvietimas::class);
    }

    public function uzsakymas()
    {
        return $this->hasMany(Uzsakymas::class);
    }

    public function preke()
    {
        return $this->hasMany(Prekes::class);
    }

    public function siunZinute()
    {
        return $this->hasMany(Zinute::class);
    }

    public function gaunZinute()
    {
        return $this->hasMany(Zinute::class);
    }

    public function rezervacija()
    {
        return $this->hasMany(Rezervacija::class);
    }

    public function statusas()
    {
        return $this->hasOne(Statusas::class);
    }
}
