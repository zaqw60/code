<?php

namespace App\Services;

use App\Models\News;
use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\DB;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{
    private string $link;

    /**
     * @param string $link
     * @return ParserService
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return void
     */
    public function saveParseData(): void
    {
        $xml = XmlParser::load($this->link);

        $data = $xml->parse([
            'title' =>[
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,pubDate,description,category,author]'
            ]
        ]);


        $category = [
            'title' => $data['description'],
            'description' => $data['link'],
            'created_at' => now()
        ];
        if (!DB::table('categories')->where('title', $data['description'])->first()){
            DB::table('categories')->insert($category);
        }


        foreach ($data['news'] as $item) {
            $news = [
                'category_id' => DB::table('categories')->where('title' , $data['description'])->value('id'),
                'source_id' => DB::table('sources')->where('url' , $this->link)->value('id'),
                'title' => $item['title'],
                'author' => $item['author'],
                'status' => News::DRAFT,
                'image' => $data['image'],
                'description' => $item['description'],
                'created_at' => now()
            ];

            if (!DB::table('news')->where('title', $item['title'])->first()){
                DB::table('news')->insert($news);
            }
        }
    }
}
