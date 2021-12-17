<?php

namespace Database\Seeders;

use Database\Factories\WinkPostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        WinkPostFactory::new()->count(15)->create();
    }
}
