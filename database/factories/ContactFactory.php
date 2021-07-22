<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => mt_rand(1,5),
            'name' => $this->faker->name(),
            'tel' => mt_rand(100000, 999999),
            'email' => $this->faker->email()
        ];
    }
}
