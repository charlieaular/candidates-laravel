<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthTest extends TestCase {

  use DatabaseMigrations;

  private $loginApi;

  public function setUp(): void {
    parent::setUp();

    $this->loginApi = "/api/auth";
  }

  public function testShouldLoginSuccessfully() {
    $user = User::factory()->create([
      "is_active" => true,
    ]);

    $credentials = [
      "username" => $user->username,
      "password" => "123456",
    ];

    $response = $this->postJson($this->loginApi, $credentials);

    $response
      ->assertStatus(200)
      ->assertJsonStructure([
        "meta" => [
          "success",
          "errors"
        ],
        "data" => [
          "token",
          "minutes_to_expire"
        ]
      ]);

    $this
      ->assertAuthenticated('api')
      ->assertAuthenticatedAs($user);
  }

  public function testShouldThrowErrorWhenUserDeactivated() {
    $user = User::factory()->create([
      "is_active" => false,
    ]);

    $credentials = [
      "username" => $user->username,
      "password" => "123456",
    ];

    $response = $this->postJson($this->loginApi, $credentials);

    $response
      ->assertStatus(401)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["User {$user->username} is deactivated"]
        ],
      ]);
  }

  public function testShouldThrowErrorWhenPasswordIsWrong() {
    $user = User::factory()->create([
      "is_active" => true,
    ]);

    $credentials = [
      "username" => $user->username,
      "password" => "1234s56",
    ];

    $response = $this->postJson($this->loginApi, $credentials);

    $response
      ->assertStatus(401)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["Password incorrect for user: {$user->username}"]
        ],
      ]);
  }
}
