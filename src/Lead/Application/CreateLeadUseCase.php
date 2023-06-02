<?php

namespace Src\Lead\Application;

use Src\Lead\Domain\Candidate;
use Src\Lead\Domain\Contracts\LeadRepositoryContract;

final class CreateLeadUseCase {

  private $repository;

  public function __construct(LeadRepositoryContract $repository) {
    $this->repository = $repository;
  }

  public function __invoke(Candidate $candidate) {
    return $this->repository->createLead($candidate);
  }
}
