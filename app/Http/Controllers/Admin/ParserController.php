<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\JobNewsParsing;
use App\Services\Contracts\Parser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Parser $parser
     * @return Response
     */
    public function __invoke(Request $request, Parser $parser)
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
            \dispatch(new JobNewsParsing($url));
        }

        return "Parsing completed";
    }
}
