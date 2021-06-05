<?php
namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;


class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        \App\Models\Post::factory()->count(20)->create(); 
    }
}
