<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'nuotraukos';

    const CREATED_AT = 'data_sukurta';
    const UPDATED_AT = 'data_atnaujinta';

    protected $guarded = [];

    public function preke()
    {
        return $this->belongsTo(Prekes::class);
    }

    public function uzduotis()
    {
        return $this->belongsTo(Uzduotis::class);
    }
}
