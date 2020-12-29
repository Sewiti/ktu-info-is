<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VartotojoTipas extends Model
{
    use HasFactory;

    public function vartotojas() {
        return $this->belongsTo(Vartotojas::class);
    }
}
