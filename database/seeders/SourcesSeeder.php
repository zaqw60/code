<?php

declare(strict_types=1);

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
        {
            DB::table('sources')->insert($this->getData());
        }
        protected function getData(): array
            {
                $faker = Factory::create();
                $data = [];

                for ($i=0; $i<10; $i++){
                    $data[] = [
                        'title' => $faker -> jobTitle(),
                        'url' => $faker ->url(),
                        'created_at' => now('Europe/Moscow')
                    ];
                }
                return $data;
            }
}

