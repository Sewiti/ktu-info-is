<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymas extends Model
{
    use HasFactory;

    const CREATED_AT = 'data_sukurta';
    const UPDATED_AT = 'data_atnaujinta';

    protected $fillable = [
        'vartotojo_id',
        'kodas',
        'pvm',
        'nuolaida',
        'visa_suma'
    ];

    public function busena() {
        return $this->hasMany(Busena::class, 'uzsakymo_id');
    }

    public function uzsakymoPreke() {
        return $this->hasMany(UzsakymoPreke::class, 'uzsakymo_id');
    }

    public function vartotojas() {
        return $this->belongsTo(Vartotojas::class, 'vartotojo_id');
    }

    public function uzduotis() {
        return $this->hasOne(Uzduotis::class);
    }
}
