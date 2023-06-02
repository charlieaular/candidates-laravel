<?php

namespace Src\Lead\Infrastructure\Controllers;

use Src\Lead\Application\CreateLeadUseCase;
use Src\Lead\Domain\Candidate;
use Src\Lead\Domain\ValueObjects\LeadCreatedBy;
use Src\Lead\Domain\ValueObjects\LeadName;
use Src\Lead\Domain\ValueObjects\LeadOwner;
use Src\Lead\Domain\ValueObjects\LeadSource;
use Src\Lead\Infrastructure\Repositories\LeadRepository;

final class CreateLeadController {

  private $repository;

  public function __construct(LeadRepository $repository) {
    $this->repository = $repository;
  }

  public function __invoke(string $name, string $source, int $owner, int $createdBy) {

    $getLeadsUseCase = new CreateLeadUseCase($this->repository);
    
    $leadName = new LeadName($name);
    $leadSource = new LeadSource($source);
    $leadOwner = new LeadOwner($owner);
    $createdBy = new LeadCreatedBy($createdBy);
    
    $candidate = Candidate::create(
      leadName: $leadName,
      leadSource: $leadSource,
      leadOwner: $leadOwner,
      leadCreatedBy: $createdBy,
    );

    $data = $getLeadsUseCase->__invoke($candidate);
    return $data;
  }
}
