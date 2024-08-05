<?php

namespace Database\Seeders;

use App\Models\City\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $file = file_get_contents("storage/json/cities.json");
        $cities = json_decode($file, false);
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
