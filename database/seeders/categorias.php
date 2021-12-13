<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\categoria;

class categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            ['nome' => 'Diamante', 'descricao' => 'clientes categoria diamante'],
            ['nome' => 'Ouro', 'descricao' => 'clientes categoria ouro'],
            ['nome' => 'Prata', 'descricao' => 'clientes categoria prata'],
            ['nome' => 'Bronze', 'descricao' => 'clientes categoria bronze']
        ];
        foreach ($categorias as $categoria){
            categoria::updateOrCreate($categoria);
        }
    }
}
