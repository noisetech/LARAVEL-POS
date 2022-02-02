<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'nomor_telepon' => $this->faker->phoneNumber()
        ];
    }
}
