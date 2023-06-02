<?php

namespace Src\Auth\Application;

use Exception;
use Src\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Auth\Domain\ValueObjects\UserId;

final class SaveLastLoginUseCase {
  private $repository;

  public function __construct(AuthRepositoryContract $repository) {
    $this->repository = $repository;
  }

  public function __invoke(int $userId) {
    $userId = new UserId($userId);

    $this->repository->saveLastLogin($userId);
  }
}
