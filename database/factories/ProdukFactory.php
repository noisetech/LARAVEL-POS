<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            'nama_produk' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'deskripsi' => $this->faker->name(),
            'harga_modal' => $this->faker->numberBetween(20000, 100000),
            'harga_jual' => $this->faker->numberBetween(20000, 100000),
        ];
    }
}
