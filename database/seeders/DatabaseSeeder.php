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
      'username' => 'aliazhar',
      'email' => 'aliazhar.idx@gmail.com',
      'password' => Hash::make('123'),
      'role' => 'owner'
    ]);

    User::create([
      'name' => 'Ali Azhar Admin',
      'username' => 'aliazhar_admin',
      'email' => 'aliazhar.idx.admin@gmail.com',
      'password' => Hash::make('123'),
      'role' => 'admin'
    ]);

    User::create([
      'name' => 'Ali Azhar Member',
      'username' => 'aliazhar_member',
      'email' => 'aliazhar.idx.member@gmail.com',
      'password' => Hash::make('123'),
      'role' => 'member'
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
      'name' => 'Otomotive',
      'slug' => 'otomotive'
    ]);

    Category::create([
      'name' => 'Web Development',
      'slug' => 'web-development'
    ]);

    Category::create([
      'name' => 'Mobile App Development',
      'slug' => 'mobile-app-development'
    ]);

    Category::create([
      'name' => 'Design Inspiration',
      'slug' => 'design-inspiration'
    ]);

    Category::create([
      'name' => 'Productivity Tools',
      'slug' => 'productivity-tools'
    ]);

    Category::create([
      'name' => 'Data Science',
      'slug' => 'data-science'
    ]);

    Category::create([
      'name' => 'Machine Learning',
      'slug' => 'machine-learning'
    ]);

    Category::create([
      'name' => 'Gaming',
      'slug' => 'gaming'
    ]);

    Category::create([
      'name' => 'Health and Fitness',
      'slug' => 'health-and-fitness'
    ]);

    Category::create([
      'name' => 'Travel',
      'slug' => 'travel'
    ]);

    Category::create([
      'name' => 'Food and Cooking',
      'slug' => 'food-and-cooking'
    ]);

    Post::factory(100)->create();
  }
}
