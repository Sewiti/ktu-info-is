<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzduotis extends Model
{
    use HasFactory;

    const CREATED_AT = 'data_sukurta';
    const UPDATED_AT = 'data_atnaujinta';

    public function uzsakymas() {
        return $this->belongsTo(Uzsakymas::class);
    }

    public function rezervacija() {
        return $this->belongsTo(Rezervacija::class);
    }

    public function nuotrauka() {
        return $this->hasMany(Image::class);
    }

    public function statusas() {
        return $this->hasOne(Statusas::class);
    }
}
