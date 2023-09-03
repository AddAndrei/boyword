<?php

namespace App\Models\Skills;

use App\Exceptions\GeneralJsonException;
use App\Exceptions\SkillsExceptions\FieldNotGreaterValueException;
use App\Http\Extensions\RelationsTraits\RelationImageTrait;
use App\Models\BaseModel;
use App\Models\Images\Image;
use Carbon\Carbon;
use App\Http\DTO\DTO;


/**
 * Class Skills
 * @package App\Models\Skills
 * @property int $id
 * @property int $level = 1
 * @property int $experience = 0
 * @property float $attack_speed = 0.00015
 * @property int $damage = 1
 * @property string $skill_type
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $image_id
 * @property Image $image
 * @author Shcerbakov Andrei
 */
class Skill extends BaseModel
{
    use RelationImageTrait;

    /** @var int */
    private const LEVEL = 1;
    /** @var int */
    private const EXPERIENCE = 0;
    /** @var float */
    private const ATTACK_SPEED = 0.00015;
    /** @var int */
    private const DAMAGE = 1;

    protected $fillable = [
        'level',
        'experience',
        'damage',
        'skill_type',
        'skill_id',
        'parent_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'attack_speed' => 'float',
    ];

    protected $attributes = [
        'level' => self::LEVEL,
        'experience' => self::EXPERIENCE,
        'attack_speed' => self::ATTACK_SPEED,
        'damage' => self::DAMAGE,
    ];

    public function checkValues(DTO $dto, array $fieldsCheck): self|GeneralJsonException
    {
        foreach ($fieldsCheck as $field) {
            if ($dto->{$field} && $this->{$field} >= $dto->{$field}) {
                throw new FieldNotGreaterValueException("Value field $field not must be less or equal current value! Current value: {$this->{$field}}");
            }else{
                continue;
            }
        }
        return $this;
    }

}
