<?php
namespace Modules\Common\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\Common\Constants\Utilities;
use Modules\Common\Models\Category;
use Modules\Core\Models\User;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Common\Models\Post::class;

    protected function withFaker()
    {
        return \Faker\Factory::create('en');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(rand(4, 8), true);
        $body = $this->faker->paragraphs(rand(10, 30), true);
        $user = User::all('id')->pluck('id')->toArray();
        $categories = Category::where('group', 'posts')->get('id')->pluck('id')->toArray();
        $types = Utilities::PRODUCT_2_TYPE;
        $createdAt = $this->faker->dateTimeBetween('-1 years', 'now', 'Asia/Jakarta');

        $category = $categories[array_rand($categories)];

        $arrPublished = [
            Carbon::parse($createdAt)->addDays(rand(0, 300)),
            null,
        ];

        $randPublished = $arrPublished[array_rand($arrPublished)];

        return [
            'id' => Str::random(8),
            'title' => $title,
            'slug_title' => slug($title),
            'category_id' => $category,
            'type' => $types[array_rand($types)]['value'],
            'thumbnail' => $this->faker->imageUrl(),
            'price' => $this->faker->text(170),
            'description' => $body,
            'tags' => implode(',', $this->faker->words(rand(3, 5))),
            'reading_time' => round(str_word_count(strip_tags($body)) / 130, 1) . ' menit',
            'number_of_views' => rand(0, 200),
            'author' => $user[rand(0, count($user) - 1)],
            'published_at' => $randPublished,
            'published_by' => $randPublished ? $user[rand(0, count($user) - 1)] : null,
            'archived_at' => $randPublished ? null : $arrPublished[0],
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
