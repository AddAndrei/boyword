<?php

namespace App\Http\Services\Analyze;

use App\Models\Analisator\Correlate;
use App\Models\Analisator\Counter;
use App\Models\Analisator\Hero;
use GuzzleHttp\Client;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\DomCrawler\Crawler;

class AnalyzeService
{
    private $botName = "caperDotabot";
    private $username = "caper_dota_bot";
    private $chat_id = -1002844691045;
    private $token = "8150464582:AAEXwnplcnciSePAChOCd2yp9jK0Tsfiym4";

    public function __construct(private Client $client)
    {
    }

    private const FIRST_TEAM = 0;
    private const SECOND_TEAM = 1;

    public function analyzeGame(FormRequest $request): string
    {
        $teams = $request->get('teams');
        $leftPicks = array_column($teams[self::FIRST_TEAM]['picks'], 'hero');
        $rightPicks = array_column($teams[self::SECOND_TEAM]['picks'], 'hero');
        $leftStrong = $this->getStrongTeam($leftPicks, $rightPicks);
        $rightStrong = $this->getStrongTeam($rightPicks, $leftPicks);
        $correlate = new Correlate();
        $correlate->left_team_strong = $leftStrong;
        $correlate->right_team_strong = $rightStrong;
        $correlate->forecast = ($leftStrong < 0 && $rightStrong > 0) ? "Должен выиграть левый драфт" : "Должен выиграть правый драфт";
        $correlate->predict = $leftStrong < 0 && $rightStrong > 0;
        $correlate->result = "";
        $correlate->save();
        if($request->has('sendTelegramm') && $request->get('sendTelegramm') === true) {
            $this->sendToTG($teams, $correlate->forecast, $request->get('matchUrl'));
        }

        if ($leftStrong < 0 && $rightStrong > 0) {
            return "leftDraft: {$leftStrong} rightDraft: {$rightStrong} Выиграет левый драфт ID: $correlate->id";
        } elseif ($leftStrong > 0 && abs($rightStrong) > $leftStrong) {
            return "leftDraft: {$leftStrong} rightDraft: {$rightStrong} Выиграет правый драфт ID: $correlate->id";
        } else {
            return "leftDraft: {$leftStrong} rightDraft: {$rightStrong} я хуй знает кто выиграет!!";
        }
    }

    private function sendToTG(array $teams, string $forecast, string $matchUrl = null): void
    {
        $leftTeam = $teams[self::FIRST_TEAM]['team'];
        $rightTeam = $teams[self::SECOND_TEAM]['team'];
        $leftPicks = array_column($teams[self::FIRST_TEAM]['picks'], 'hero');
        $rightPicks = array_column($teams[self::SECOND_TEAM]['picks'], 'hero');
        $text = "<b>Прогноз</b>" . PHP_EOL;
        $text .= "Сейчас начнётся заруба между $leftTeam vs $rightTeam..." . PHP_EOL;
        $text .= "По предварительным данным $forecast". PHP_EOL;
        if($matchUrl) {
            $text .= "Ссылка на матч $matchUrl".PHP_EOL;
        }
        $text .= "<b>Пики карты</b>" . PHP_EOL;
        $query = [
            "chat_id" => $this->chat_id,
            "text" => $text,
            "parse_mode" => 'html',
            "reply_markup" => json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => "$leftTeam | $rightTeam",
                            'callback_data' => 'test_3',
                        ],
                    ],
                    [
                        [
                            'text' => $leftPicks[0],
                            'callback_data' => 'test_3',
                        ],

                        [
                            'text' => $rightPicks[0],
                            'callback_data' => 'test_4',
                        ],
                    ],
                    [
                        [
                            'text' => $leftPicks[1],
                            'callback_data' => 'test_3',
                        ],

                        [
                            'text' => $rightPicks[1],
                            'callback_data' => 'test_4',
                        ],
                    ],
                    [
                        [
                            'text' => $leftPicks[2],
                            'callback_data' => 'test_3',
                        ],

                        [
                            'text' => $rightPicks[2],
                            'callback_data' => 'test_4',
                        ],
                    ],
                    [
                        [
                            'text' => $leftPicks[3],
                            'callback_data' => 'test_3',
                        ],

                        [
                            'text' => $rightPicks[3],
                            'callback_data' => 'test_4',
                        ],
                    ],
                    [
                        [
                            'text' => $leftPicks[4],
                            'callback_data' => 'test_3',
                        ],

                        [
                            'text' => $rightPicks[4],
                            'callback_data' => 'test_4',
                        ],
                    ],
                ],
            ])
        ];
        $str = http_build_query($query);
        $this->client->get("https://api.telegram.org/bot{$this->token}/sendMessage?{$str}");
    }

    private function getStrongTeam(array $leftDraft, array $rightDraft): float
    {
        $teamStrong = [];
        foreach ($leftDraft as $heroName) {
            $rightCountres = Counter::where('hero_name', $heroName)->whereIn('vs_hero', $rightDraft)->groupBy('vs_hero')->get();
            $leftHero = Hero::where('title', $heroName)->orderBy('win_rate', 'DESC')->first();
            $heroK = ($leftHero->win_rate - 50);
            $array = [];
            $array[] = $heroK;
            foreach ($rightCountres as $countre) {
                $array[] = ($countre->win_rate - 50);
            }
            $teamStrong[] = array_sum($array);

        }
        return array_sum($teamStrong);
    }


    public function correlationMatches(): void
    {
        for ($page = 100; $page < 839; $page++) {
            $url = "https://dota2.ru/esport/matches/?page=$page";
            $response = $this->client->get($url);
            $crawler = new Crawler($response->getBody()->getContents());
            $matches = $crawler->filter('.past-matches-list')
                ->children('.list-match-item');
            foreach ($matches as $match) {
                $this->getPicks($match->childNodes->item(1)->childNodes->item(5)->getAttribute('href'));
            }
        }

    }

    private function getNumberMatch(string $url): int
    {
        return (int)last(array_unique(explode('/', $url)));
    }

    public function getPicks(string $url): void
    {
        $numberMatch = $this->getNumberMatch($url);
        if (Correlate::where('match_id', $numberMatch)->exists()) {
            return;
        }

        $baseUrl = "https://dota2.ru" . $url;
        $response = $this->client->get($baseUrl);
        $crawler = new Crawler($response->getBody()->getContents());

        $teams = $crawler->filter('.cybersport-matches__matches-time');
        $heroes = $crawler->filter('.table__hero-name');
        foreach ($teams as $i => $item) {
            $resultMatch = explode(":", trim($item->nodeValue));
            $pool = $this->getPoolHeroesInMatch($heroes);
            $leftDraftStrong = $this->getStrongTeam($pool[$i][self::FIRST_TEAM], $pool[$i][self::SECOND_TEAM]);
            $rightDraftStrong = $this->getStrongTeam($pool[$i][self::SECOND_TEAM], $pool[$i][self::FIRST_TEAM]);
            $forecast = ($leftDraftStrong > $rightDraftStrong) ? "Должен выиграть левый драфт" : "Должен выиграть правый драфт";
            $predict = (($resultMatch[self::FIRST_TEAM] > $resultMatch[self::SECOND_TEAM]) && ($leftDraftStrong > $rightDraftStrong));
            $result = ($resultMatch[self::FIRST_TEAM] > $resultMatch[self::SECOND_TEAM]) ? "Выиграл левый драфт {predict}" : "Выиграл правый драфт {predict}";
            $queess = ($predict) ? "прогноз верен" : "прогноз неверен";
            $result = str_replace("{predict}", $queess, $result);
            $correlate = new Correlate();
            $correlate->match_id = $numberMatch;
            $correlate->forecast = $forecast;
            $correlate->left_team_strong = $leftDraftStrong;
            $correlate->right_team_strong = $rightDraftStrong;
            $correlate->result = $result;
            $correlate->predict = $predict;
            $correlate->save();
        }
    }


    private function getPoolHeroesInMatch(Crawler $heroes): array
    {
        $array = [];
        foreach ($heroes as $value) {
            $array[] = trim($value->nodeValue);
        }
        $heroesArray = array_chunk($array, 10);
        foreach ($heroesArray as $i => $subArray) {
            $heroesArray[$i] = array_chunk($subArray, 5);
        }
        return $heroesArray;
    }
}
