<?php

namespace Src\Lead\Infrastructure\Controllers;

use Src\Lead\Application\GetLeadByIdUseCase;
use Src\Lead\Domain\ValueObjects\LeadId;
use Src\Lead\Infrastructure\Repositories\LeadRepository;

final class GetLeadByIdController {

  private $repository;

  public function __construct(LeadRepository $repository) {
    $this->repository = $repository;
  }

  public function __invoke(int $leadId) {

    $getLeadsUseCase = new GetLeadByIdUseCase($this->repository);
    $leadId = new LeadId($leadId);
    $data = $getLeadsUseCase->__invoke($leadId);
    return $data;
  }
}
