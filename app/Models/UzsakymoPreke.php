<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UzsakymoPreke extends Model
{
    use HasFactory;

    protected $table = 'uzsakymo_preke';

    public $timestamps = false;

    protected $fillable = [
        'prekes_id',
        'uzsakymo_id',
        'kiekis',
        'kaina'
    ];

    public function uzsakymas() {
        return $this->belongsTo(Uzsakymas::class, 'uzsakymo_id');
    }

    public function preke() {
        return $this->belongsTo(Prekes::class, 'uzsakymo_id');
    }
}
