<?php

namespace App\Http\Services\Parser;

use App\Models\Analisator\GetMatch;
use App\Models\Analisator\Pick;
use App\Models\Analisator\Player;
use App\Models\Analisator\Team;
use DOMElement;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ParserService
{
    private const LEFT_TEAM = 0;
    private const RIGHT_TEAM = 1;
    private const URL = "https://www.cybersport.ru";

    public function __construct(private Client $client)
    {
    }

    /**
     * @throws GuzzleException
     */
    public function updateTeams(string $url): void
    {
        $response = $this->client->get($url);
        $crawler = new Crawler($response->getBody()->getContents());
        $teams = $crawler->filter('.root_RxXkH');
        foreach ($teams as $i => $value) {
            /** @var DOMElement $value */
            $teamName = $value->firstChild->firstChild->nextSibling->nodeValue;
            if (Team::where('title', trim($teamName))->exists() && Player::where('nick', 'like', "%$teamName%")->exists()) {
                continue;
            }
            $team = Team::firstOrNew([
                'title' => trim($teamName)
            ]);
            $team->save();

            $this->getPlayerStatistic($team, $value->firstChild->nextSibling->firstChild->getAttribute('href'), 1);
            $this->getPlayerStatistic($team, $value->firstChild->nextSibling->firstChild->nextSibling->getAttribute('href'), 2);
            $this->getPlayerStatistic($team, $value->firstChild->nextSibling->firstChild->nextSibling->nextSibling->getAttribute('href'), 3);
            $this->getPlayerStatistic($team, $value->firstChild->nextSibling->firstChild->nextSibling->nextSibling->nextSibling->getAttribute('href'), 4);
            $this->getPlayerStatistic($team, $value->firstChild->nextSibling->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->getAttribute('href'), 5);
        }
    }

    /**
     * @throws GuzzleException
     */
    private function getPlayerStatistic(Team $team, string $url, int $position): void
    {
        $playerUrl = self::URL . $url;
        $response = $this->client->get($playerUrl);
        $crawler = new Crawler($response->getBody()->getContents());
        $playerNick = $crawler->filter('.title_RAvdm');
        $winRate = $crawler->filter('.percent_LRP0D');
        $nick = '';
        $rate = '';
        foreach ($playerNick as $value) {
            $nick = $value->nodeValue;
        }
        foreach ($winRate as $value) {
            $rate = (float)Str::between($value->firstChild->firstChild->nextSibling->nodeValue, '(', ')');
        }
        $t = Player::firstOrNew([
            'nick' => "$team->title.$nick",
            'win_rate' => $rate,
            'position' => $position,
        ]);
        $t->save();
    }

    /**
     * @throws GuzzleException
     */
    public function matches($url): void
    {
        //$url = "https://dota2.ru/esport/matches/";
        $response = $this->client->get($url);
        $crawler = new Crawler($response->getBody()->getContents());
        $matches = $crawler->filter('.past-matches-list')
            ->children('.list-match-item');
        foreach ($matches as $match) {
            $this->getPicks($match->childNodes->item(1)->childNodes->item(5)->getAttribute('href'));
        }
    }

    private function getNumberMatch(string $url): int
    {
        return (int)last(array_unique(explode('/', $url)));
    }

    /**
     * @throws GuzzleException
     */
    public function getPicks(string $url): void
    {
        $numberMatch = $this->getNumberMatch($url);
        if (GetMatch::where('match_id', $numberMatch)->exists()) {
            return;
        }
        $getMatch = new GetMatch();
        $getMatch->match_id = $numberMatch;
        $getMatch->save();
        $baseUrl = "https://dota2.ru" . $url;
        $response = $this->client->get($baseUrl);
        $crawler = new Crawler($response->getBody()->getContents());

        $teams = $crawler->filter('.cybersport-matches__matches-time');
        $heroes = $crawler->filter('.table__hero-name');
        foreach ($teams as $i => $item) {
            $resultMatch = explode(":", trim($item->nodeValue));
            $pool = $this->getPoolHeroesInMatch($heroes);
            if ($resultMatch[self::LEFT_TEAM] < $resultMatch[self::RIGHT_TEAM]) {
                $pool[$i] = array_reverse($pool[$i]);
            }
            $this->createOrUpdatePick($pool[$i]);
        }
    }

    private function createOrUpdatePick(array $pool): void
    {
        for ($y = 0; $y < 5; ++$y) {
            $winHero = $pool[self::LEFT_TEAM][$y];
            $loseHero = $pool[self::RIGHT_TEAM][$y];
            $position = $y + 1;
            if (Pick::where([['win_hero', $winHero], ['lose_hero', $loseHero], ['position', $position]])->exists()) {
                Pick::where([['win_hero', $winHero], ['lose_hero', $loseHero]])->increment('matches');
            } else {
                $pick = new Pick();
                $pick->win_hero = $winHero;
                $pick->lose_hero = $loseHero;
                $pick->win_rate = 0;
                $pick->matches = 1;
                $pick->position = $position;
                $pick->save();
            }
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
