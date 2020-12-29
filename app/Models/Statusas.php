<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statusas extends Model
{
    use HasFactory;

    public function rezervacija() {
        return $this->belongsTo(Rezervacija::class);
    }

    public function uzduotis() {
        return $this->belongsTo(Uzduotis::class);
    }

    public function vartotojas() {
        return $this->belongsTo(Vartotojas::class);
    }
}
