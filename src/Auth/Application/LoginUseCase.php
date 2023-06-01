<?php

namespace Src\Auth\Application;

use Exception;
use Src\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Auth\Domain\Exceptions\WrongPasswordException;
use Src\Auth\Domain\ValueObjects\Password;
use Src\Auth\Domain\ValueObjects\UserName;

final class LoginUseCase {
  private $repository;

  public function __construct(AuthRepositoryContract $repository) {
    $this->repository = $repository;
  }

  public function __invoke(string $userName, string $password) {
    $userNameVO = new UserName($userName);
    $passwordVO = new Password($password);

    $token = $this->repository->login($userNameVO, $passwordVO);

    if (!$token) throw new WrongPasswordException($userNameVO->value());


    return $token;

  }
}
