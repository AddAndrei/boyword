<?php

namespace App\Models;

use App\Http\DTO\DTO;
use App\Http\Extensions\FiltersAndSortingPaginateTrait;
use App\Models\Adds\Add;
use App\Models\Auth\Profile;
use App\Models\Auth\Rating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string|null $name
 *
 * @property string $password
 * @property string $token
 * @property string $phone
 * @property HasMany $adds
 * @property HasOne $profile
 * @author Shcerbakov Andrei
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FiltersAndSortingPaginateTrait;

    protected $with = [
        'profile',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    /**
     * Заполнение аттрибутов
     *
     * @param DTO $data
     * @return $this
     */
    public function propagateFromDTO(DTO $data): self
    {
        foreach ($data->toArray() as $field => $value) {
            $this->$field = $value;
        }
        return $this;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function adds(): HasMany
    {
        return $this->hasMany(Add::class, 'user_id');
    }

    public function byName(Builder $query, string $value): Builder
    {
        return $query->where("name", "like", "%$value%");
    }

    public function byBanned(Builder $query, bool $value): Builder
    {
        return $value ? $query->whereHas('ban') : $query->doesntHave('ban');
    }

    public function byEmail(Builder $query, string $value): Builder
    {
        return $query->where("email", "like", "%$value%");
    }



}
