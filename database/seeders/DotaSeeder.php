<?php

namespace Database\Seeders;

use App\Models\Analisator\Player;
use App\Models\Analisator\Team;
use App\Models\Analisator\TeamPlayer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DotaSeeder extends Seeder
{
    private array $teams = [
        'BetBoom' => [
            [
                'nick' => 'Pure~',
                'win_rate' => 55,
                'position' => 1,
            ],
            [
                'nick' => 'gpK~',
                'win_rate' => 51,
                'position' => 2,
            ],
            [
                'nick' => 'MieRo',
                'win_rate' => 49,
                'position' => 3,
            ],
            [
                'nick' => 'Save-',
                'win_rate' => 51,
                'position' => 4,
            ],
            [
                'nick' => 'Kataomi',
                'win_rate' => 57,
                'position' => 5,
            ],
        ],
        "Yakult's Bro" => [
            [
                'nick' => 'flyfly',
                'win_rate' => 53,
                'position' => 1,
            ],
            [
                'nick' => 'Emo',
                'win_rate' => 54,
                'position' => 2,
            ],
            [
                'nick' => 'BEYOND',
                'win_rate' => 44,
                'position' => 3,
            ],
            [
                'nick' => 'BoBoKa',
                'win_rate' => 44,
                'position' => 4,
            ],
            [
                'nick' => 'Oli',
                'win_rate' => 53,
                'position' => 5,
            ],
        ],
        'Gladiators' => [
            [
                'nick' => 'Watson',
                'win_rate' => 49,
                'position' => 1,
            ],
            [
                'nick' => 'Quinn',
                'win_rate' => 54,
                'position' => 2,
            ],
            [
                'nick' => 'Ace',
                'win_rate' => 54,
                'position' => 3,
            ],
            [
                'nick' => 'tOfu',
                'win_rate' => 54,
                'position' => 4,
            ],
            [
                'nick' => 'Malady',
                'win_rate' => 43,
                'position' => 5,
            ],
        ],
        'Nigma' => [
            [
                'nick' => 'KuroKy',
                'win_rate' => 48,
                'position' => 1,
            ],
            [
                'nick' => 'Miracle-',
                'win_rate' => 49,
                'position' => 2,
            ],
            [
                'nick' => 'SumaiL',
                'win_rate' => 51,
                'position' => 3,
            ],
            [
                'nick' => 'No!ob',
                'win_rate' => 52,
                'position' => 4,
            ],
            [
                'nick' => 'GH',
                'win_rate' => 49,
                'position' => 5,
            ],
            [
                'nick' => 'OmaR',
                'win_rate' => 43,
                'position' => 0,
            ],
        ],
        'PARIVISION' => [
            [
                'nick' => 'Satanic',
                'win_rate' => 65,
                'position' => 1,
            ],
            [
                'nick' => 'No[o]ne',
                'win_rate' => 61,
                'position' => 2,
            ],
            [
                'nick' => 'DM',
                'win_rate' => 61,
                'position' => 3,
            ],
            [
                'nick' => '9Class',
                'win_rate' => 61,
                'position' => 4,
            ],
            [
                'nick' => 'Dukalis',
                'win_rate' => 62,
                'position' => 5,
            ],
        ],
        'Talon' => [
            [
                'nick' => '23savage',
                'win_rate' => 25,
                'position' => 1,
            ],
            [
                'nick' => 'Mikoto',
                'win_rate' => 50,
                'position' => 2,
            ],
            [
                'nick' => 'Ws',
                'win_rate' => 53,
                'position' => 3,
            ],
            [
                'nick' => 'Jhocam',
                'win_rate' => 52,
                'position' => 4,
            ],
            [
                'nick' => 'Kuku',
                'win_rate' => 52,
                'position' => 5,
            ],
        ],
        'Aurora' => [
            [
                'nick' => 'Nightfall',
                'win_rate' => 49,
                'position' => 1,
            ],
            [
                'nick' => 'kiyotaka',
                'win_rate' => 48,
                'position' => 2,
            ],
            [
                'nick' => 'TORONTOTOKYO',
                'win_rate' => 49,
                'position' => 3,
            ],
            [
                'nick' => 'Mira',
                'win_rate' => 49,
                'position' => 4,
            ],
            [
                'nick' => 'Panto',
                'win_rate' => 49,
                'position' => 5,
            ],
        ],
        'Liquid' => [
            [
                'nick' => 'miCKe',
                'win_rate' => 52,
                'position' => 1,
            ],
            [
                'nick' => 'Nisha',
                'win_rate' => 53,
                'position' => 2,
            ],
            [
                'nick' => 'SabeRLighT-',
                'win_rate' => 47,
                'position' => 3,
            ],
            [
                'nick' => 'Boxi',
                'win_rate' => 52,
                'position' => 4,
            ],
            [
                'nick' => 'iNSaNiA',
                'win_rate' => 51,
                'position' => 5,
            ],
        ],
        'Natus Vincere' => [
            [
                'nick' => 'Yuragi',
                'win_rate' => 71,
                'position' => 1,
            ],
            [
                'nick' => 'Copy',
                'win_rate' => 52,
                'position' => 2,
            ],
            [
                'nick' => 'BOOM',
                'win_rate' => 56,
                'position' => 3,
            ],
            [
                'nick' => 'Ari',
                'win_rate' => 71,
                'position' => 4,
            ],
            [
                'nick' => 'Kaori',
                'win_rate' => 59,
                'position' => 5,
            ],
        ],
        'One Move' => [
            [
                'nick' => 'Eyesight',
                'win_rate' => 46,
                'position' => 1,
            ],
            [
                'nick' => 'Difference',
                'win_rate' => 50,
                'position' => 2,
            ],
            [
                'nick' => 'zvёzd',
                'win_rate' => 50,
                'position' => 3,
            ],
            [
                'nick' => 'not me',
                'win_rate' => 49,
                'position' => 4,
            ],
            [
                'nick' => 'Bb3px',
                'win_rate' => 46,
                'position' => 5,
            ],
        ],
        'L1ga Team' => [
            [
                'nick' => 'you < <',
                'win_rate' => 42,
                'position' => 1,
            ],
            [
                'nick' => 'erase',
                'win_rate' => 50,
                'position' => 2,
            ],
            [
                'nick' => 'Malik',
                'win_rate' => 52,
                'position' => 3,
            ],
            [
                'nick' => 'mrls',
                'win_rate' => 52,
                'position' => 4,
            ],
            [
                'nick' => 'RESPECT',
                'win_rate' => 46,
                'position' => 5,
            ],
        ],
        'MOUZ' => [
            [
                'nick' => 'Kami',
                'win_rate' => 33,
                'position' => 1,
            ],
            [
                'nick' => 'Abed',
                'win_rate' => 44,
                'position' => 2,
            ],
            [
                'nick' => 'zeal',
                'win_rate' => 33,
                'position' => 3,
            ],
            [
                'nick' => 'Ekki',
                'win_rate' => 33,
                'position' => 4,
            ],
            [
                'nick' => 'Seleri',
                'win_rate' => 33,
                'position' => 5,
            ],
        ],
        'OG' => [
            [
                'nick' => 'Shad',
                'win_rate' => 36,
                'position' => 1,
            ],
            [
                'nick' => 'Stormstormer',
                'win_rate' => 33,
                'position' => 2,
            ],
            [
                'nick' => 'MikSa`',
                'win_rate' => 36,
                'position' => 3,
            ],
            [
                'nick' => 'Daze',
                'win_rate' => 31,
                'position' => 4,
            ],
            [
                'nick' => 'Kidaro',
                'win_rate' => 0,
                'position' => 5,
            ],
        ],
        'AVULUS' => [
            [
                'nick' => 'Smiling Knight',
                'win_rate' => 49,
                'position' => 1,
            ],
            [
                'nick' => 'Worick',
                'win_rate' => 67,
                'position' => 2,
            ],
            [
                'nick' => 'Xibbe',
                'win_rate' => 50,
                'position' => 3,
            ],
            [
                'nick' => 'dEsire',
                'win_rate' => 39,
                'position' => 4,
            ],
            [
                'nick' => 'Fly',
                'win_rate' => 37,
                'position' => 5,
            ],
        ],
        'Heroic' => [
            [
                'nick' => 'Yuma',
                'win_rate' => 55,
                'position' => 1,
            ],
            [
                'nick' => '4nalog',
                'win_rate' => 49,
                'position' => 2,
            ],
            [
                'nick' => 'Wisper',
                'win_rate' => 55,
                'position' => 3,
            ],
            [
                'nick' => 'Scofield',
                'win_rate' => 51,
                'position' => 4,
            ],
            [
                'nick' => 'KJ',
                'win_rate' => 49,
                'position' => 5,
            ],
        ],
        'OG LATAM' => [
            [
                'nick' => 'K1',
                'win_rate' => 35,
                'position' => 1,
            ],
            [
                'nick' => 'TaiLung',
                'win_rate' => 60,
                'position' => 2,
            ],
            [
                'nick' => 'ILICH-',
                'win_rate' => 35,
                'position' => 3,
            ],
            [
                'nick' => 'elmisho',
                'win_rate' => 35,
                'position' => 4,
            ],
            [
                'nick' => 'MoOz',
                'win_rate' => 35,
                'position' => 5,
            ],
        ],
        'Edge' => [
            [
                'nick' => 'payk',
                'win_rate' => 29,
                'position' => 1,
            ],
            [
                'nick' => 'PiPi',
                'win_rate' => 29,
                'position' => 2,
            ],
            [
                'nick' => 'Vitaly',
                'win_rate' => 29,
                'position' => 3,
            ],
            [
                'nick' => 'Matthew',
                'win_rate' => 67,
                'position' => 4,
            ],
            [
                'nick' => 'Yadomi',
                'win_rate' => 29,
                'position' => 5,
            ],
        ],
        'Team Den' => [
            [
                'nick' => 'Wits',
                'win_rate' => 20,
                'position' => 1,
            ],
            [
                'nick' => 'osito',
                'win_rate' => 33,
                'position' => 2,
            ],
            [
                'nick' => 'Frank',
                'win_rate' => 20,
                'position' => 3,
            ],
            [
                'nick' => 'Demon',
                'win_rate' => 20,
                'position' => 4,
            ],
            [
                'nick' => 'Mjz',
                'win_rate' => 20,
                'position' => 5,
            ],
        ],
        'Xtreme Gaming' => [
            [
                'nick' => 'Ame',
                'win_rate' => 60,
                'position' => 1,
            ],
            [
                'nick' => 'Xm',
                'win_rate' => 52,
                'position' => 2,
            ],
            [
                'nick' => 'Xxs',
                'win_rate' => 60,
                'position' => 3,
            ],
            [
                'nick' => 'XinQ',
                'win_rate' => 60,
                'position' => 4,
            ],
            [
                'nick' => 'Poloson',
                'win_rate' => 46,
                'position' => 5,
            ],
        ],
        'Shopify Rebellion' => [
            [
                'nick' => 'Timado',
                'win_rate' => 52,
                'position' => 1,
            ],
            [
                'nick' => 'Yopaj',
                'win_rate' => 51,
                'position' => 2,
            ],
            [
                'nick' => 'Hellscream',
                'win_rate' => 52,
                'position' => 3,
            ],
            [
                'nick' => 'Skem',
                'win_rate' => 49,
                'position' => 4,
            ],
            [
                'nick' => 'BuLba',
                'win_rate' => 0,
                'position' => 5,
            ],
        ],
        'Wildcard Gaming' => [
            [
                'nick' => 'YamSun',
                'win_rate' => 53,
                'position' => 1,
            ],
            [
                'nick' => 'RCY',
                'win_rate' => 53,
                'position' => 2,
            ],
            [
                'nick' => 'Fayde',
                'win_rate' => 53,
                'position' => 3,
            ],
            [
                'nick' => 'Bignum',
                'win_rate' => 53,
                'position' => 4,
            ],
            [
                'nick' => 'Speeed',
                'win_rate' => 53,
                'position' => 5,
            ],
        ],
        'BOOM Esports' => [
            [
                'nick' => 'JaCkky',
                'win_rate' => 47,
                'position' => 1,
            ],
            [
                'nick' => 'Mac',
                'win_rate' => 55,
                'position' => 2,
            ],
            [
                'nick' => 'Fbz',
                'win_rate' => 55,
                'position' => 3,
            ],
            [
                'nick' => 'Tims',
                'win_rate' => 53,
                'position' => 4,
            ],
            [
                'nick' => 'Jaunuel',
                'win_rate' => 47,
                'position' => 5,
            ],
        ],
        'Execration' => [
            [
                'nick' => 'Abat',
                'win_rate' => 42,
                'position' => 1,
            ],
            [
                'nick' => 'Lewis',
                'win_rate' => 48,
                'position' => 2,
            ],
            [
                'nick' => 'Tino-',
                'win_rate' => 45,
                'position' => 3,
            ],
            [
                'nick' => 'Shanks',
                'win_rate' => 41,
                'position' => 4,
            ],
            [
                'nick' => 'cml',
                'win_rate' => 50,
                'position' => 5,
            ],
        ],
        'Virtus.pro' => [
            [
                'nick' => 'V-Tune',
                'win_rate' => 57,
                'position' => 1,
            ],
            [
                'nick' => 'Lorenof',
                'win_rate' => 61,
                'position' => 2,
            ],
            [
                'nick' => 'Daxak',
                'win_rate' => 61,
                'position' => 3,
            ],
            [
                'nick' => 'Antares',
                'win_rate' => 57,
                'position' => 4,
            ],
            [
                'nick' => 'Rein',
                'win_rate' => 61,
                'position' => 5,
            ],
        ],
        'Team Secret' => [
            [
                'nick' => 'Parker',
                'win_rate' => 63,
                'position' => 1,
            ],
            [
                'nick' => 'xn丶e',
                'win_rate' => 55,
                'position' => 2,
            ],
            [
                'nick' => 'MikSa`2',
                'win_rate' => 63,
                'position' => 3,
            ],
            [
                'nick' => 'Thiolicor',
                'win_rate' => 63,
                'position' => 4,
            ],
            [
                'nick' => 'Puppey',
                'win_rate' => 60,
                'position' => 5,
            ],
        ],
        'Runa Team' => [
            [
                'nick' => 'Shigetsu',
                'win_rate' => 67,
                'position' => 1,
            ],
            [
                'nick' => 'nicky`cool',
                'win_rate' => 67,
                'position' => 2,
            ],
            [
                'nick' => 'Alberkaaa',
                'win_rate' => 63,
                'position' => 3,
            ],
            [
                'nick' => 'queezy',
                'win_rate' => 67,
                'position' => 4,
            ],
            [
                'nick' => 'Hduo',
                'win_rate' => 67,
                'position' => 5,
            ],
        ],
        'Nemiga Gaming' => [
            [
                'nick' => 'bashka',
                'win_rate' => 48,
                'position' => 1,
            ],
            [
                'nick' => 'спортик',
                'win_rate' => 25,
                'position' => 2,
            ],
            [
                'nick' => 'Covisnine',
                'win_rate' => 48,
                'position' => 3,
            ],
            [
                'nick' => 'xsvampire',
                'win_rate' => 49,
                'position' => 4,
            ],
            [
                'nick' => 'monodrama',
                'win_rate' => 48,
                'position' => 5,
            ],
        ],
        'Natus Vincere Junior' => [
            [
                'nick' => 'gotthejuice',
                'win_rate' => 56,
                'position' => 1,
            ],
            [
                'nick' => 'Niku',
                'win_rate' => 58,
                'position' => 2,
            ],
            [
                'nick' => 'pma',
                'win_rate' => 56,
                'position' => 3,
            ],
            [
                'nick' => 'Zayac',
                'win_rate' => 64,
                'position' => 4,
            ],
            [
                'nick' => 'Riddys',
                'win_rate' => 56,
                'position' => 5,
            ],
        ],
        '1win Team' => [
            [
                'nick' => 'Munkushi~',
                'win_rate' => 57,
                'position' => 1,
            ],
            [
                'nick' => 'Squad1x',
                'win_rate' => 71,
                'position' => 2,
            ],
            [
                'nick' => 'TripleSSS',
                'win_rate' => 71,
                'position' => 3,
            ],
            [
                'nick' => 'swedenstrong',
                'win_rate' => 57,
                'position' => 4,
            ],
            [
                'nick' => 'kasane',
                'win_rate' => 71,
                'position' => 5,
            ],
        ],
        'Vici Gaming' => [
            [
                'nick' => 'Paparazi',
                'win_rate' => 50,
                'position' => 1,
            ],
            [
                'nick' => 'Ori',
                'win_rate' => 50,
                'position' => 2,
            ],
            [
                'nick' => 'Yang',
                'win_rate' => 50,
                'position' => 3,
            ],
            [
                'nick' => 'Kaka',
                'win_rate' => 50,
                'position' => 4,
            ],
            [
                'nick' => 'Dy',
                'win_rate' => 50,
                'position' => 5,
            ],
        ],
        'InterActive Philippines' => [
            [
                'nick' => 'Marb',
                'win_rate' => 23,
                'position' => 1,
            ],
            [
                'nick' => 'Nishababy',
                'win_rate' => 25,
                'position' => 2,
            ],
            [
                'nick' => 'Luciano',
                'win_rate' => 23,
                'position' => 3,
            ],
            [
                'nick' => 'Matt2',
                'win_rate' => 23,
                'position' => 4,
            ],
            [
                'nick' => 'Kim0',
                'win_rate' => 23,
                'position' => 5,
            ],
        ],
        'Team Nemesis' => [
            [
                'nick' => 'Akashi',
                'win_rate' => 70,
                'position' => 1,
            ],
            [
                'nick' => 'Mac2',
                'win_rate' => 70,
                'position' => 2,
            ],
            [
                'nick' => 'Raven',
                'win_rate' => 70,
                'position' => 3,
            ],
            [
                'nick' => 'Jing',
                'win_rate' => 70,
                'position' => 4,
            ],
            [
                'nick' => 'Erice',
                'win_rate' => 70,
                'position' => 5,
            ],
        ],
    ];

    public function run(): void
    {
        foreach ($this->teams as $team => $players) {
            if (!Team::where('title', $team)->exists()) {
                $newTeam = new Team();
                $newTeam->title = $team;
                $newTeam->save();
            } else {
                $newTeam = Team::where('title', $team)->firstOrFail();
            }
            foreach ($players as $player) {
                if (!Player::where('nick', $player['nick'])->exists()) {
                    $newPlayer = new Player();
                    $newPlayer->nick = $player['nick'];
                    $newPlayer->win_rate = $player['win_rate'];
                    $newPlayer->position = $player['position'];
                    $newPlayer->save();
                } else {
                    $newPlayer = Player::where('nick', $player['nick'])->firstOrFail();
                    $newPlayer->position = $player['position'];
                    $newPlayer->save();
                }
                if (TeamPlayer::where('player_id', $newPlayer->id)->exists()) {
                    TeamPlayer::where('player_id', $newPlayer)->update([
                        'team_id' => $newTeam->id,
                        'player_id' => $newPlayer->id,
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    $teamPlayer = new TeamPlayer();
                    $teamPlayer->team()->associate($newTeam);
                    $teamPlayer->player()->associate($newPlayer);
                    $teamPlayer->save();
                }
            }
        }
    }

}
