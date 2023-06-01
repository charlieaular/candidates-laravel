<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Src\Shared\Domain\ValueObjects\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            "username" => $this->faker->username(),
            "password" => Hash::make("123456"),
            "last_login" => now(),
            "is_active" => $this->faker->boolean(),
            "role" => $this->faker->randomElement(Role::cases()),
            "created_at" => now(),
        ];
    }

    public function createManagerRole(): UserFactory {
        return $this->state(function() {
            $role = Role::Manager;

            return [
                "role" => $role->value
            ];
        });
    }

    public function createAgentRole(): UserFactory {
        return $this->state(function() {
            $role = Role::Agent;

            return [
                "role" => $role->value
            ];
        });
    }
}
