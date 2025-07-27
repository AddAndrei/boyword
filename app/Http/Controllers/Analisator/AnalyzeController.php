<?php

namespace App\Http\Controllers\Analisator;

use App\Http\Controllers\Controller;
use App\Http\Services\Analyze\AnalyzeService;
use App\Http\Services\Parser\ParserService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Artisan;


class AnalyzeController extends Controller
{

    public function __construct(private ParserService $service, private AnalyzeService $analyzeService)
    {
    }

    public function getHero(FormRequest $request)
    {
        $aspect = $request->get('aspect');
    }

    public function analyze(FormRequest $request)
    {
        return $this->analyzeService->analyzeGame($request);
    }


    public function updateHeroes(): void
    {
        Artisan::call('db:seed --class=HeroesSeeder');
    }

    /**
     * @throws GuzzleException
     */
    public function updateTeams(FormRequest $request): void
    {
        $url = $request->get('url');
        $this->service->updateTeams($url);
    }

    /**
     * @throws GuzzleException
     */
    public function getPicks(FormRequest $request): void
    {
        $url = $request->get('url');
        /*for($i = 70; $i < 836; ++$i) {
            $url = "https://dota2.ru/esport/matches/?page=$i";
            $this->service->matches($url);
            echo "one page parsed! \n\r iterator = $i";
        }*/
        $this->service->matches($url);
    }
}
