<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\Category;

class PostsFakerTableSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker\Factory::create();
        for($i = 1; $i <= 10; $i++){
            $post = new \App\Post();
            $post->title = $faker->name;
            $post->user_id = 1;
            $post->contents = $faker->text(2500);
            $post->publish = 1;
            $post->image = "default.png";
            $post->save();
            $post->categories()->attach([1, 2, 3]);
        }

    }
}
