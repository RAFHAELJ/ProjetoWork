<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;

    function clientes(){
        return $this->hasMany(cliente::class, 'cliente_id');
    }
}
