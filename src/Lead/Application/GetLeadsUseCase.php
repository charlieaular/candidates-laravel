<?php

namespace Src\Lead\Application;

use Src\Lead\Domain\Contracts\LeadRepositoryContract;

final class GetLeadsUseCase {

  private $repository;

  public function __construct(LeadRepositoryContract $repository) {
    $this->repository = $repository;
  }

  public function __invoke()
  {
    return $this->repository->getAllLeads();
  }
}