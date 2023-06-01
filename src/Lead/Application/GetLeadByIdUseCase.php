<?php

namespace Src\Lead\Application;

use Src\Lead\Domain\Contracts\LeadRepositoryContract;
use Src\Lead\Domain\ValueObjects\LeadId;

final class GetLeadByIdUseCase {

  private $repository;

  public function __construct(LeadRepositoryContract $repository) {
    $this->repository = $repository;
  }

  public function __invoke(LeadId $leadId) {
    return $this->repository->getAllLeadById($leadId);
  }
}
