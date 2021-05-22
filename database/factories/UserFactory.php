<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
//            'slug' => $this->faker->slug,
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            "phone" => $this->faker->phoneNumber,
            'password' => "password", // password
            "role_id" => \App\Models\Role::inRandomOrder()->pluck('id')->first(),
            'remember_token' => Str::random(10),
            "commune_id" => \App\Models\Commune::inRandomOrder()->pluck('id')->first()
        ];
    }
}
