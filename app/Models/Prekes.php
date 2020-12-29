<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prekes extends Model
{
    const CREATED_AT = 'data_sukurta';
    const UPDATED_AT = 'data_atnaujinta';

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
