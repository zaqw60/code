<?php

declare(strict_types=1);

namespace Database\Seeders;

//use Faker\Factory;
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
                $urls = [
                    'https://news.rambler.ru/rss/SaintPetersburg',
                    'https://news.rambler.ru/rss/Zaporozhye',
                    'https://news.rambler.ru/rss/holiday',
                    'https://news.rambler.ru/rss/technology',
                    'https://news.rambler.ru/rss/gifts',
                    'https://news.rambler.ru/rss/world',
                    'https://news.rambler.ru/rss/moscow_city',
                    'https://news.rambler.ru/rss/politics',
                    'https://news.rambler.ru/rss/community',
                    'https://news.rambler.ru/rss/incidents',
                    'https://news.rambler.ru/rss/tech',
                    'https://news.rambler.ru/rss/starlife',
                    'https://news.rambler.ru/rss/army',
                    'https://news.rambler.ru/rss/games',
                    'https://news.rambler.ru/rss/articles',
                    'https://news.rambler.ru/rss/video',
                    'https://news.rambler.ru/rss/photo',
                    'https://news.rambler.ru/rss/podcast',
                ];

                foreach ($urls as $url) {
                    $e = \explode("/", $url);
                    $title = end($e);
                    $data[] = [
                        'title' => $title,
                        'url' => $url,
                        'created_at' => now('Europe/Moscow')
                    ];
                }
                return $data;
            }
}

