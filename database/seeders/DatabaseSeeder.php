<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\estados;
use Database\Seeders\categorias;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(estados::class);
        $this->call(categorias::class);
    }
}