<?php

namespace Database\Seeders;

use App\Models\City\City;
use Illuminate\Database\Seeder;
use JsonException;

class CitySeeder extends Seeder
{
    /**
     * @return void
     * @throws JsonException
     */
    public function run(): void
    {
        $file = file_get_contents("storage/json/cities.json");
        $cities = json_decode($file, false, 512, JSON_THROW_ON_ERROR);
        foreach ($cities as $city) {
            $cityPoint = "{$city->subject} , {$city->name}";
            if (!City::where('title', $cityPoint)->exists()) {
                $newCity = new City();
                $newCity->title = $cityPoint;
                $newCity->save();
            }
        }
    }
}
