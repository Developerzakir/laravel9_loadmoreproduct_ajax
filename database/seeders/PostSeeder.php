<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num_posts = 80;

        // Use a loop to create multiple users
        for ($i = 1; $i < $num_posts; $i++) {
        Post::create([
            'title' => "Test title $i",
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod consequuntur vero facilis perspiciatis.",
          ]);
        }
    }
}
