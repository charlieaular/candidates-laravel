<?php

namespace Src\Lead\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Lead\Application\GetLeadsByOwnerUseCase;
use Src\Lead\Application\GetLeadsUseCase;
use Src\Lead\Infrastructure\Repositories\LeadRepository;

final class GetLeadsByOwnerControllers {

  private $repository;

  public function __construct(LeadRepository $repository) {
    $this->repository = $repository;
  }

  public function __invoke(int $owerId) {
    $getLeadsUseCase = new GetLeadsByOwnerUseCase($this->repository);
    $data = $getLeadsUseCase->__invoke($owerId);
    return $data;
  }
}
