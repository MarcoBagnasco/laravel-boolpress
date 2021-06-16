<?php

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            $new_post = new Post();

            $new_post->title = 'Title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi illum in voluptate iure, provident repudiandae, cumque nisi esse hic dolor incidunt veritatis! Eos perspiciatis delectus pariatur dolorem tenetur incidunt sunt.';

            $new_post->save();
        }
    }
}
