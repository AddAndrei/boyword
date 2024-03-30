<?php

namespace App\Http\Services\Clans;

use App\Exceptions\ClanException\HeroInAnotherClanException;
use App\Exceptions\ClanException\HeroInClanExistException;
use App\Http\DTO\Clans\CreateClanDTO;
use App\Models\Clans\Clan;
use App\Models\Clans\HeroesInClan;
use App\Models\Hero\Hero;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ClanService
{
    private array $relations = [
        'hero_id' => [
            'entity' => Hero::class,
            'method' => 'creatorHero',
        ],
    ];

    /**
     * @param Clan $clan
     * @param CreateClanDTO $dto
     * @return Clan
     * @throws HeroInAnotherClanException
     * @throws HeroInClanExistException
     */
    public function store(Clan $clan, CreateClanDTO $dto): Clan
    {
        $user = User::find(Auth::id());
        $hero = Hero::find($dto->hero_id);
        if(HeroesInClan::where('hero_id', $hero->id)->exists()) {
            throw new HeroInAnotherClanException();
        }
        if (HeroesInClan::where([['hero_id', $hero->id], ['clan_id', $clan->id]])->exists()) {
            throw new HeroInClanExistException();
        }
        $clan->creator()->associate($user);
        $clan->creatorHero()->associate($hero);
        $clan->updateRelations($dto, $this->relations);
        $clan->propagateFromDTO($dto)->save();
        $this->heroAttachments($clan, $hero);
        return $clan->load(['heroes.hero']);
    }

    /**
     * @param Clan $clan
     * @param Hero $hero
     * @return void
     */
    public function heroAttachments(Clan $clan, Hero $hero): void
    {
        $addHeroInClan = new HeroesInClan();
        $addHeroInClan->hero()->associate($hero);
        $addHeroInClan->clan()->associate($clan);
        $addHeroInClan->save();
    }
}
