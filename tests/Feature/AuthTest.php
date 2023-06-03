<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

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

  public function testShouldThrowErrorWhenJWTTokenIsInvalid() {

    $user = User::factory()->create();

    $this->actingAsUser($user);

    $this->withHeader('Authorization', "Bearer bad-token");

    $response = $this->getJson("/api/lead");

    // $response->dd();

    $response
      ->assertStatus(401)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["Token invalid"]
        ],
      ]);
  }

  public function testShouldThrowErrorWhenJWTTokenIsExpired() {

    $user = User::factory()->create();

    $token = JWTAuth::customClaims(['exp' => now()->addSeconds(1)->timestamp])->fromUser($user);
    $this->withHeader('Authorization', "Bearer {$token}");
    $this->actingAs($user);

    sleep(2);

    $response = $this->getJson("/api/lead");

    $response
      ->assertStatus(401)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["Token expired"]
        ],
      ]);
  }

  public function testShouldThrowErrorWhenJWTTokenIsMissing() {

    $response = $this->getJson("/api/lead");

    $response
      ->assertStatus(401)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["Authorization Token not found"]
        ],
      ]);
  }
}
