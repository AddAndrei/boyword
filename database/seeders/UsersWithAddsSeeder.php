<?php

namespace Database\Seeders;

use App\Models\Adds\Add;
use App\Models\Auth\Profile;
use App\Models\Categories\Category;
use App\Models\City\City;
use App\Models\Color\Color;
use App\Models\Image\Image;
use App\Models\Mark\Mark;
use App\Models\User;
use App\Models\Volume\VolumeMemory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UsersWithAddsSeeder extends Seeder
{
    private array $profiles = [
        'Иван Иванов | +7 912 345 67 01',
        'Ольга Смирнова | +7 903 212 34 02',
        'Алексей Петров | +7 926 987 65 03',
        'Мария Кузнецова | +7 915 654 32 04',
        'Дмитрий Волков | +7 909 876 54 05',
        'Екатерина Морозова | +7 921 345 67 06',
        'Сергей Васильев | +7 925 123 45 07',
        'Анна Лебедева | +7 904 567 89 08',
        'Михаил Соколов | +7 913 432 10 09',
        'Наталья Новикова | +7 907 654 32 10',
        'Алексей Федоров | +7 912 345 67 11',
        'Елена Морозова | +7 903 212 34 12',
        'Андрей Ковалев | +7 926 987 65 13',
        'Татьяна Романова | +7 915 654 32 14',
        'Максим Дмитриев | +7 909 876 54 15',
        'Ирина Воронова | +7 921 345 67 16',
        'Владимир Сидоров | +7 925 123 45 17',
        'Оксана Кузьмина | +7 904 567 89 18',
        'Константин Лебедев | +7 913 432 10 19',
        'Светлана Васильева | +7 907 654 32 20',
        'Дмитрий Орлов | +7 912 345 67 21',
        'Наталья Белова | +7 903 212 34 22',
        'Михаил Николаев | +7 926 987 65 23',
        'Виктория Григорьева | +7 915 654 32 24',
        'Евгений Захаров | +7 909 876 54 25',
        'Ольга Гусева | +7 921 345 67 26',
        'Игорь Кузнецов | +7 925 123 45 27',
        'Полина Соколова | +7 904 567 89 28',
        'Сергей Михайлов | +7 913 432 10 29',
        'Анастасия Попова | +7 907 654 32 30',
        'Алексей Львов | +7 912 345 67 31',
        'Марина Тихонова | +7 903 212 34 32',
        'Павел Широков | +7 926 987 65 33',
        'Юлия Киселева | +7 915 654 32 34',
        'Виктор Смирнов | +7 909 876 54 35',
        'Дарья Козлова | +7 921 345 67 36',
        'Антон Сорокин | +7 925 123 45 37',
        'Наталья Савина | +7 904 567 89 38',
        'Василий Фролов | +7 913 432 10 39',
        'Екатерина Жукова | +7 907 654 32 40',
        'Алексей Ермаков | +7 912 345 67 41',
        'Светлана Павлова | +7 903 212 34 42',
        'Николай Громов | +7 926 987 65 43',
        'Ирина Морозова | +7 915 654 32 44',
        'Евгений Васильев | +7 909 876 54 45',
        'Ольга Попова | +7 921 345 67 46',
        'Андрей Кравцов | +7 925 123 45 47',
        'Марина Новикова | +7 904 567 89 48',
        'Дмитрий Федоров | +7 913 432 10 49',
        'Наталья Кузьмина | +7 907 654 32 50',
        'Владимир Волков | +7 912 345 67 51',
        'Екатерина Никитина | +7 903 212 34 52',
        'Сергей Егоров | +7 926 987 65 53',
        'Татьяна Лебедева | +7 915 654 32 54',
        'Михаил Коновалов | +7 909 876 54 55',
        'Оксана Чернова | +7 921 345 67 56',
        'Иван Соколов | +7 925 123 45 57',
        'Алена Родина | +7 904 567 89 58',
        'Константин Михайлов | +7 913 432 10 59',
        'Дарья Васильева | +7 907 654 32 60',
        'Александр Орлов | +7 912 345 67 61',
        'Мария Белова | +7 903 212 34 62',
        'Виктор Степанов | +7 926 987 65 63',
        'Юлия Иванова | +7 915 654 32 64',
        'Андрей Павлов | +7 909 876 54 65',
        'Ольга Кузнецова | +7 921 345 67 66',
        'Сергей Николаев | +7 925 123 45 67',
        'Инна Лебедева | +7 904 567 89 68',
        'Павел Соколов | +7 913 432 10 69',
        'Светлана Морозова | +7 907 654 32 70',
        'Виктор Иванов | +7 912 345 67 71',
        'Анна Петрова | +7 903 212 34 72',
        'Михаил Смирнов | +7 926 987 65 73',
        'Наталья Козлова | +7 915 654 32 74',
        'Дмитрий Орлов | +7 909 876 54 75',
        'Елена Соколова | +7 921 345 67 76',
        'Иван Федоров | +7 925 123 45 77',
        'Марина Васильева | +7 904 567 89 78',
        'Алексей Новиков | +7 913 432 10 79',
        'Ирина Морозова | +7 907 654 32 80',
        'Сергей Жуков | +7 912 345 67 81',
        'Татьяна Ермакова | +7 903 212 34 82',
        'Андрей Савельев | +7 926 987 65 83',
        'Оксана Никитина | +7 915 654 32 84',
        'Константин Громов | +7 909 876 54 85',
        'Дарья Лебедева | +7 921 345 67 86',
        'Иван Кравцов | +7 925 123 45 87',
        'Юлия Волкова | +7 904 567 89 88',
        'Михаил Козлов | +7 913 432 10 89',
        'Анна Королева | +7 907 654 32 90',
        'Алексей Широков | +7 912 345 67 91',
        'Наталья Романова | +7 903 212 34 92',
        'Сергей Захаров | +7 926 987 65 93',
        'Ольга Лебедева | +7 915 654 32 94',
        'Дмитрий Фролов | +7 909 876 54 95',
        'Марина Родина | +7 921 345 67 96',
        'Владимир Николаев | +7 925 123 45 97',
        'Екатерина Кузьмина | +7 904 567 89 98',
        'Андрей Михайлов | +7 913 432 10 99',
        'Ирина Савина | +7 907 654 32 100',
        'Иван Волков | +7 912 345 67 101',
        'Юлия Белова | +7 903 212 34 102',
        'Михаил Соколов | +7 926 987 65 103',
        'Наталья Морозова | +7 915 654 32 104',
        'Александр Кузнецов | +7 909 876 54 105',
        'Оксана Васильева | +7 921 345 67 106',
        'Дмитрий Никитин | +7 925 123 45 107',
        'Татьяна Иванова | +7 904 567 89 108',
        'Константин Павлов | +7 913 432 10 109',
        'Анастасия Морозова | +7 907 654 32 110',
        'Сергей Смирнов | +7 912 345 67 111',
        'Марина Васильева | +7 903 212 34 112',
        'Павел Ковалев | +7 926 987 65 113',
        'Ирина Березина | +7 915 654 32 114',
        'Виктория Лебедева | +7 909 876 54 115',
        'Алексей Горбунов | +7 921 345 67 116',
        'Ольга Смирнова | +7 925 123 45 117',
        'Михаил Новиков | +7 904 567 89 118',
        'Елена Морозова | +7 913 432 10 119',
        'Дмитрий Кузнецов | +7 907 654 32 120',
    ];
    private array $avatars = [
        '9wK8gCCA1DiodwfTnWnvFade2yPpNQ68fw8T9w8o',
        'caDYkIYDHb5OqYZuhbLtLtGCRdIQO8dX5PGQmsCW',
        'epavwL8sU3tKfUo3fQRpuCweczLmxP4ovmSBEFdG',
        'guiPJLFBsDTKpU8geYHHQK7O3rMuSImHoy7WZ0cV',
    ];

    public function run(): void
    {
        $this->createAvatars();
        $this->createUser();
    }

    private function createAvatars(): void
    {
        foreach ($this->avatars as $avatar) {
            $image = env('APP_URL') . '/public/images/time/' . $avatar . '.webp';
            if (!Image::where('url', $image)->exists()) {
                $newImage = new Image();
                $newImage->url = $image;
                $newImage->save();
            }
        }
    }

    private function createUser(): void
    {
        foreach ($this->profiles as $profile) {
            $name = explode('|', $profile);
            $nameAndLastname = explode(' ', rtrim($name[0]));
            $phone = str_replace(' ', '', $name[1]);
            if (!User::where('phone', $phone)->exists()) {
                $user = new User();
                $user->phone = $phone;
                $user->name = $nameAndLastname[0];
                $user->password = bcrypt('33589791');
                $user->save();
                $profile = new Profile();
                $profile->name = $nameAndLastname[0];
                $profile->last_name = $nameAndLastname[1];
                $profile->user()->associate($user);
                $profile->save();
                $this->createAdds($user);
            }
        }
    }

    private function createAdds(User $user = null): void
    {
        $addCount = rand(1, 6);
        for ($i = 0; $i < $addCount; $i++) {
            $city = City::inRandomOrder()->first();
            $price = rand(100, 100000);
            $title = fake()->jobTitle();
            $description = fake()->realText();
            $category = rand(1, 3);
            if ($category === 1) {
                $mark = Mark::inRandomOrder()->with('models')->first();
                $model_id = $mark->models->random()->model_id;
                $model = Model::find($model_id);
                $color = Color::inRandomOrder()->first();
                $memory = VolumeMemory::inRandomOrder()->first();
                $aggregate = "$mark->title $model->title $memory->title $color->title";
                $filtrate = (int)"$mark->id $model_id $memory->id $color->id";
                $add = new Add();
                $add->category_id = $category;
                $add->title = $title;
                $add->description = $description;
                $add->price = $price;
                $add->aggregate = $aggregate;
                $add->filtrate = $filtrate;
                $add->status = 'confirmed';
                $add->mark()->associate($mark);
                $add->model()->associate($model);
                $add->memory()->associate($memory);
                $add->color()->associate($color);
                $add->user()->associate($user);
                $add->city()->associate($city);
                $add->save();
                $this->addImages($add);
            }else{
                $add = new Add();
                $categoryModel = Category::find($category);
                $aggregate = $categoryModel->title;
                $filtrate = (int)"$category";
                $add->title = $title;
                $add->description = $description;
                $add->aggregate = $aggregate;
                $add->filtrate = $filtrate;
                $add->price = $price;
                $add->status = 'confirmed';
                $add->category_id = $category;
                $add->city()->associate($city);
                $add->user()->associate($user);
                $add->save();
                $this->addImages($add);
            }
        }
    }
    private function addImages(Add $add): void
    {
        $imagesCount = rand(1, 4);
        for ($y = 0; $y < $imagesCount; $y++) {
            $url = env('APP_URL') . '/public/images/time/' . $this->avatars[$y] . '.webp';
            $image = new Image();
            $image->url = $url;
            $image->add()->associate($add);
            $image->save();
        }
    }
}
