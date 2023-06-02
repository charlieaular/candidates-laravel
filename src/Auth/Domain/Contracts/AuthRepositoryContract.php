<?php

namespace Src\Auth\Domain\Contracts;

use Src\Auth\Domain\ValueObjects\Password;
use Src\Auth\Domain\ValueObjects\UserId;
use Src\Auth\Domain\ValueObjects\UserName;

interface AuthRepositoryContract {

  public function login(UserName $userName, Password $password);

  public function saveLastLogin(UserId $userId);

}
