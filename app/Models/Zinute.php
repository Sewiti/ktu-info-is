<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zinute extends Model
{
    use HasFactory;

    protected $table = 'zinute';

    const CREATED_AT = 'data_sukurta';
    const UPDATED_AT = 'data_atnaujinta';

    public function zinutesStatusas()
    {
        return $this->hasOne(ZinutesStatusas::class);
    }

    // From/to relations? meh
}
