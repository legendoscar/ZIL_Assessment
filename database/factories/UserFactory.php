<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;


class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id' => $this->faker->randomNumber(),
            'prefixname' => $this->faker->randomElement(['Mr', 'Mrs', 'Ms']),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'suffixname' => $this->faker->randomElement(['Jr.', 'Sr.', 'I', 'II', 'III', 'IV', 'V', 'VI']),
            'username' => $this->faker->unique()->username(),
            'photo' => $this->faker->image('public/uploads',640,480, null, false),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
