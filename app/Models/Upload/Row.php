<?php

namespace App\Models\Upload;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Row
 * @package App\Models\Upload
 * @property string|null $name
 * @property Carbon|null $date
 * @author Shcerbakov Andrei
 */
class Row extends Model
{
    public $timestamps = false;

    protected $table = 'rows';

    protected $fillable = [
        'name',
        'date',
    ];

    protected $dates = [
        'date',
    ];
}
