<?php

namespace Src\Lead\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Lead\Application\GetLeadsUseCase;
use Src\Lead\Infrastructure\Repositories\LeadRepository;

final class GetLeadsControllers {

  private $repository;

  public function __construct(LeadRepository $repository) {
    $this->repository = $repository;
  }

  public function __invoke() {

    $getLeadsUseCase = new GetLeadsUseCase($this->repository);
    $data = $getLeadsUseCase->__invoke();
    return $data;
  }
}
