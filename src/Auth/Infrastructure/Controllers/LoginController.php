<?php
declare(strict_types=1);

namespace Src\Auth\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Auth\Application\LoginUseCase;
use Src\Auth\Infrastructure\Repositories\AuthRepository;

final class LoginController {

  private $repository;

  public function __construct(AuthRepository $repository) {

    $this->repository = $repository;
  }

  public function __invoke(string $username, string $password) {

    $loginUseCase = new LoginUseCase($this->repository);
    $token = $loginUseCase->__invoke($username, $password);
    return $token;
  }
}
