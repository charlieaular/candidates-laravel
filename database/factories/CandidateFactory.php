<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            "name" => $this->faker->name(),
            "source" => $this->faker->domainWord(),
            "owner" => User::factory(),
            "created_by" => User::factory(),
            "created_at" => now(),
        ];
    }
}
