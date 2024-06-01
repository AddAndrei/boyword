<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categories\Category;
use App\Models\Mark\Mark;
use App\Models\Models\Model;
use Carbon\Carbon;
use Database\Factories\Marks\MarksList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{



    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createCategories();
        $this->createMarksAndModels();

         //\App\Models\User::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    private function createCategories(): void
    {
        foreach (MarksList::CATEGORIES as $category) {
            DB::table('categories')->insert([
                'title' => $category,
                'created_at' => Carbon::now(),
            ]);
        }
    }
    private function createMarksAndModels(): void
    {
        foreach(MarksList::BRANDS as $marks => $models) {
            $mark = DB::table('marks')->insertGetId([
                'title' => $marks,
                'created_at' => Carbon::now(),
            ]);
            foreach ($models as $model){
                $model = DB::table('models')->insertGetId([
                    'title' => $model,
                    'created_at' => Carbon::now(),
                ]);
                DB::table('marks_models_pivot')->insert([
                    'mark_id' => $mark,
                    'model_id' => $model
                ]);
            }
        }
    }

}
