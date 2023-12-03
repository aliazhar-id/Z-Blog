<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
  private function generateRandomDateTime()
  {
    // Generate random year between 2020 and 2023
    $year = random_int(2020, 2023);

    // Generate random month between 1 and 12
    $month = random_int(1, 12);

    // Generate random day between 1 and the number of days in the current month
    $day = random_int(1, cal_days_in_month(CAL_GREGORIAN, $month, $year));

    // Generate random hour between 0 and 23
    $hour = random_int(0, 23);

    // Generate random minute between 0 and 59
    $minute = random_int(0, 59);

    // Generate random second between 0 and 59
    $second = random_int(0, 59);

    // Create date time stamp with random date and time
    $dateTime = mktime($hour, $minute, $second, $month, $day, $year);

    return date('Y-m-d H:i:s', $dateTime);
  }

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $created_at = fake()->dateTimeBetween('2020-01-01', '-3 days')->format('Y-m-d H:i:s');

    return [
      'title' => fake()->sentence(mt_rand(4, 7)),
      'slug' => fake()->slug(),
      'excerpt' => fake()->paragraph(),
      'body' => collect(fake()->paragraphs(mt_rand(6, 15)))
        ->map(fn ($p) => "<p>$p</p>")
        ->implode(''),
      'image' => 'https://source.unsplash.com/700x350',
      'created_at' => $created_at,
      'updated_at' => $created_at,
      'id_user' => mt_rand(1, 5),
      'id_category' => mt_rand(1, 5)
    ];
  }
}
