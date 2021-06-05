<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //\App\Models\Category::factory()->count(10)->create(); 
        $categories = [
            ['id' => 1, 'name' => 'Principal'],
            ['id' => 2, 'name' => 'Secundaria'],
            ['id' => 3, 'name' => 'Importante'],
            ['id' => 4, 'name' => 'Arquivada'],
            ['id' => 5, 'name' => 'Outros']          
        ];
        Category::insert($categories);
    
    }
}
