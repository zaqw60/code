<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\JobNewsParsing;
use App\Models\Source;
use App\Services\Contracts\Parser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Parser $parser
     * @return string
     */
    public function __invoke(Request $request, Parser $parser): string
    {
        $urls = Source::all();

        foreach ($urls as $url) {
            $link = $url->url;
            \dispatch(new JobNewsParsing($link));
        }

        return "Parsing completed";
    }
}
