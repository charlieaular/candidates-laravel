<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Shared\Domain\ValueObjects\Role;
use Tests\TestCase;

class LeadTest extends TestCase {
  use WithFaker;
  use DatabaseMigrations;

  private $leadApi;

  public function setUp(): void {
    parent::setUp();

    $this->leadApi = "/api/lead";
  }

  public function testShouldRetriveAllCandidatesWhenCurrentUserIsManager() {
    $users = User::factory()->count(2)->create([
      "role" => Role::Manager
    ]);

    $candidates = Candidate::factory()->count(10)
      ->state(new Sequence(
        fn (Sequence $sequence) => ['owner' => User::all()->random()],
      ))
      ->create();

    $firstUser = $users->first();

    $this->actingAsUser($firstUser);

    $response = $this->getJson($this->leadApi);

    $response
      ->assertStatus(200)
      ->assertJsonStructure([
        "meta" => [
          "success",
          "errors"
        ],
        "data"
      ]);

    $data = $response->json()["data"];

    $candidateCount = $candidates->count();

    $this->assertCount($candidateCount, $data);
  }

  public function testShouldRetriveOwnerCandidatesWhenCurrentUserIsAgent() {
    $users = User::factory()->count(2)->create([
      "role" => Role::Agent
    ]);

    $candidates = Candidate::factory()->count(10)
      ->state(new Sequence(
        fn (Sequence $sequence) => ['owner' => User::all()->random()],
      ))
      ->create();

    $firstUser = $users->first();

    $this->actingAsUser($firstUser);

    $response = $this->getJson($this->leadApi);

    $response
      ->assertStatus(200)
      ->assertJsonStructure([
        "meta" => [
          "success",
          "errors"
        ],
        "data"
      ]);

    $data = $response->json()["data"];

    $candidateCount = $candidates->where("owner", $firstUser->id)->count();

    $this->assertCount($candidateCount, $data);
  }

  public function testShouldRetriveOneCandidate() {
    $candidates = Candidate::factory()->count(10)->create();

    $randomCandidate = $candidates->random();

    $response = $this->getJson($this->leadApi . "/" . $randomCandidate->id);

    $response
      ->assertStatus(200)
      ->assertJsonStructure([
        "meta" => [
          "success",
          "errors"
        ],
        "data"
      ]);
  }

  public function testShouldThrowErrorWhenCandidateDoesNotExists() {
    Candidate::factory()->count(10)->create();

    $response = $this->getJson($this->leadApi . "/" . "99999999999");

    $response
      ->assertStatus(404)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["No lead found"]
        ],
      ]);
  }

  public function testShouldCreateALead() {

    $user = User::factory()->create([
      "role" => Role::Manager
    ]);

    $randomUser = User::factory()->create();

    $this->actingAsUser($user);

    $body = [
      "name" => "TestName",
      "source" => "TestSource",
      "owner" => $randomUser->id,
    ];

    $response = $this->postJson($this->leadApi, $body);

    $response
      ->assertStatus(201)
      ->assertJsonStructure([
        "meta" => [
          "success",
          "errors"
        ],
        "data" => [
          "name",
          "source",
          "owner",
          "created_by",
          "created_at",
          "id",
        ]
      ]);
  }
  public function testShouldThrowErrorWhenMissingField() {

    $user = User::factory()->create([
      "role" => Role::Manager
    ]);

    $randomUser = User::factory()->create();

    $this->actingAsUser($user);

    $body = [
      "source" => "TestSource",
      "owner" => $randomUser->id,
    ];

    $response = $this->postJson($this->leadApi, $body);

    $response
      ->assertStatus(422)
      ->assertJsonStructure([
        "meta" => [
          "success",
          "errors"
        ],
      ]);
  }

  public function testShouldThrowErrorWhenCreateCandidateWhenRoleIsNotManager() {
    $user = User::factory()->create([
      "role" => Role::Agent
    ]);

    $randomUser = User::factory()->create();

    $this->actingAsUser($user);

    $body = [
      "name" => "TestName",
      "source" => "TestSource",
      "owner" => $randomUser->id,
    ];

    $response = $this->postJson($this->leadApi, $body);

    $response
      ->assertStatus(401)
      ->assertExactJson([
        "meta" => [
          "success" => false,
          "errors" => ["This action is unauthorized."]
        ],
      ]);
  }
}
