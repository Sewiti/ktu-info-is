<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakvietimas extends Model
{
    use HasFactory;

    protected $table = 'pakvietimai';
    public $timestamps = false;

    public function vartotojas()
    {
        return $this->belongsTo(Vartotojas::class);
    }
}
