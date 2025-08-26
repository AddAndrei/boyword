<?php

namespace Database\Seeders;

use App\Models\Analisator\Counter;
use App\Models\Analisator\Hero;
use DOMElement;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\DomCrawler\Crawler;

class HeroesSeeder extends Seeder
{
    private const DOTA_BUFF_META = 'https://ru.dotabuff.com/heroes';
    private const COUNTER_LINK = "/counters";

    public function __construct(private Client $client)
    {
    }

    /** @throws GuzzleException */
    #[NoReturn] public function run(): void
    {
        $response = $this->client->get(self::DOTA_BUFF_META);
        $html = html_entity_decode($response->getBody()->getContents());
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('tr');
        foreach ($crawler as $i => $value) {
            /** @var DOMElement $value */
            if ($i === 0) {
                continue;
            }
            $this->saveOrUpdateHero($value);
        }
    }

    private function saveOrUpdateHero(DOMElement $document): void
    {
        $baseUrl = "https://ru.dotabuff.com";
        $winRate = $document->firstChild->nextSibling->nextSibling->firstChild->nodeValue; //win_rate
        $title = $document->firstChild->firstChild->firstChild->lastChild->firstChild->nodeValue; // heroName
        $aspect = $document->firstChild->firstChild->firstChild->lastChild->lastChild->nodeValue; // aspect
        $url = $document->firstChild->firstChild->firstChild->lastChild->firstChild->getAttribute('href');
        if (!Hero::where([['title', $title], ['aspect', $aspect]])->exists()) {
            $hero = new Hero();
        } else {
            /** @var Hero $heroFind */
            $hero = Hero::where([['title', $title], ['aspect', $aspect]])->first();
        }
        $hero->title = $title;
        $hero->win_rate = $winRate;
        $hero->aspect = $aspect;
        $hero->url = $baseUrl . $url;
        $hero->save();
        $counter = $baseUrl . $url . self::COUNTER_LINK;
        $this->setCountres($hero, $counter);
    }

    /**
     * @throws GuzzleException
     */
    private function setCountres(Hero $hero, string $url): void
    {
        $response = $this->client->get($url);
        $crawler = new Crawler($response->getBody()->getContents());
        $countres = $crawler->filter('.sortable > tbody > tr');
        foreach ($countres as $countre) {
            if (Counter::where([['hero_id', $hero->id], ['vs_hero', $countre->firstChild->nextSibling->nodeValue]])->exists()) {
                continue;
            }
            $heroName = $countre->firstChild->nextSibling->nodeValue;
            $winrate = (float)$countre->firstChild->nextSibling->nextSibling->nextSibling->nodeValue;
            $matches = (int)$countre->firstChild->nextSibling->nextSibling->nextSibling->nextSibling->nodeValue;
            $counter = new Counter();
            $counter->hero_id = $hero->id;
            $counter->vs_hero = $heroName;
            $counter->win_rate = $winrate;
            $counter->matches = $matches;
            $counter->save();
        }
    }
}
