<?php

namespace App\Models\Skills;

use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class Axe
 * @package App\Models\Skills
 * @property int $id
 * @property int $level = 1
 * @property int $experience = 0
 * @property float $attack_speed = 0.00015
 * @property int $damage = 1
 * @author Shcerbakov Andrei
 */
class Axe extends Skill
{
    protected $table = 'axe_skill';

    protected $fillable = [
        'level',
        'experience',
        'attack_speed',
        'damage',
    ];
}
