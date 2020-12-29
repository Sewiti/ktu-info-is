<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UzsakymoStatusas extends Model
{
    use HasFactory;

    public function busena() {
        return $this->belongsTo(Busena::class);
    }
}
