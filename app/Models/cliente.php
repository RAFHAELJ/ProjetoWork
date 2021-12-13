<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
        'estado',
        'categoria_id',
        'Inicio',
        'telefone'
    ];

    public function categorias(){
        die($this->belongsTo(categoria::class, 'categoria_id'));
        return $this->belongsTo(categoria::class, 'categoria_id');
    }
}
