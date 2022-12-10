<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\Category;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        $post = new \App\Post();
        $post->title = 'Testowy wpis';
        $post->user_id = 1;
        $post->contents = "Zapraszam do przeglądu naszego blogu piłkarskiego";
        $post->publish = 1;
        $post->image = "default.png";
        $post->save();
        $post->categories()->attach([1, 2, 3]);
    }
}
