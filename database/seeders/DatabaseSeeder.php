<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    User::create([
      'name' => 'Ali Azhar',
      'username' => 'aliazhar_id',
      'email' => 'aliazhar.idx@gmail.com',
      'password' => Hash::make('123'),
    ]);

    User::factory(5)->create();

    Category::create([
      'name' => 'Freebies',
      'slug' => 'freebies'
    ]);

    Category::create([
      'name' => 'Tutorials',
      'slug' => 'tutorial'
    ]);

    Category::create([
      'name' => 'JavaScript',
      'slug' => 'javascript'
    ]);

    Category::create([
      'name' => 'Laravel 10',
      'slug' => 'laravel-10'
    ]);

    Category::create([
      'name' => 'Otomotif',
      'slug' => 'otomotif'
    ]);

    Post::factory(100)->create();
  }
}
