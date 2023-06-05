<?php

namespace App\Models\Books;

use App\Models\BaseModel;
use Carbon\Carbon;

/**
 * Class Book
 * @package App\Models\Books
 * @property string|null $name
 * @property Carbon|null $year
 * @author Shcerbakov Andrei
 */
class Book extends BaseModel
{
    protected $table = 'books';

    protected $fillable = [
        'name',
        'year',
    ];

    protected $dates = [
        'year',
    ];
}
