<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    protected $table = 'rezervacija';

    public $timestamps = false;

    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pradzios_laikas' => 'datetime',
    ];

    public function uzduotis()
    {
        return $this->hasOne(Uzduotis::class);
    }

    public function vartotojas()
    {
        return $this->belongsTo(Vartotojas::class);
    }

    public function statusas()
    {
        return $this->hasOne(Statusas::class);
    }
}
