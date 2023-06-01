<?php

namespace Src\Auth\Infrastructure\Repositories;

use App\Models\User as EloquentUserModel;
use Illuminate\Support\Facades\Auth;
use Src\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Auth\Domain\ValueObjects\Password;
use Src\Auth\Domain\ValueObjects\UserName;

final class AuthRepository implements AuthRepositoryContract {

  private $eloquentUserModel;

  public function __construct() {
    $this->eloquentUserModel = new EloquentUserModel();
  }

  public function login(UserName $name, Password $password) {

    $token = Auth::attempt(["username" => $name->value(), "password" => $password->value()]);
    return $token;

  }
}
