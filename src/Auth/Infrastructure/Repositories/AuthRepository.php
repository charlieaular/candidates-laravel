<?php

namespace Src\Auth\Infrastructure\Repositories;

use App\Models\User as EloquentUserModel;
use Illuminate\Support\Facades\Auth;
use Src\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Auth\Domain\ValueObjects\Password;
use Src\Auth\Domain\ValueObjects\UserId;
use Src\Auth\Domain\ValueObjects\UserName;

final class AuthRepository implements AuthRepositoryContract {

  private $eloquentUserModel;

  public function __construct() {
    $this->eloquentUserModel = new EloquentUserModel();
  }

  public function login(UserName $name, Password $password) {
    $token = Auth::attempt(["username" => $name, "password" => $password]);
    return $token;

  }

  public function saveLastLogin(UserId $userId) {
    $model = $this->eloquentUserModel;
    $model->where("id", $userId)->update([ "last_login" => now() ]);
  }
}
