<?php

namespace src\Lead\Infrastructure\Repositories;

use App\Models\Candidate as EloquentCandidateModel;
use Src\Lead\Domain\Contracts\LeadRepositoryContract;
use Src\Lead\Domain\ValueObjects\OwnerId;

final class LeadRepository implements LeadRepositoryContract {

  private $eloquentCandidateModel;

  public function __construct() {
    $this->eloquentCandidateModel = new EloquentCandidateModel();
  }

  public function getAllLeads() {
    return $this->eloquentCandidateModel->get()->toArray();
  }

  public function getAllLeadsByOwner(OwnerId $ownerId) {
    return $this->eloquentCandidateModel->where("owner", $ownerId->value())->get()->toArray();

  }
}
