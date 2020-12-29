<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busena extends Model
{
    use HasFactory;

    protected $table = "busena";

    public $timestamps = false;

    protected $fillable = [
        'uzsakymo_id',
        'atnaujinimo_laikas',
        'busena'
    ];

    public function uzsakymas() {
        return $this->belongsTo(Uzsakymas::class);
    }

    public function uzsakymoStatusas() {
        return $this->hasOne(UzsakymoStatusas::class);
    }
}
