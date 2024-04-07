<?php

namespace App\Models\Items;

enum ItemResourceTypeEnum: int
{
    case WEAPON = 3;
    case ARMOR = 4;
    case NECKLACES = 5;
    case DROP = 6;
}
