<?php

namespace src\Lead\Infrastructure\Repositories;

use App\Models\Candidate as EloquentCandidateModel;
use Src\Lead\Domain\Candidate;
use Src\Lead\Domain\Contracts\LeadRepositoryContract;
use Src\Lead\Domain\ValueObjects\LeadId;
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
    return $this->eloquentCandidateModel->where("owner", $ownerId)->get()->toArray();
  }

  public function getAllLeadById(LeadId $leadId) {
    return $this->eloquentCandidateModel->find($leadId)?->toArray();
  }

  public function createLead(Candidate $candidate) {

    $model = $this->eloquentCandidateModel;

    $data = [
      "name" => $candidate->leadName(),
      "source" => $candidate->leadSource(),
      "owner" => $candidate->leadOwner(),
      "created_by" => $candidate->leadCreatedBy(),
    ];
    
    return $model->create($data)?->toArray();
  }
}
