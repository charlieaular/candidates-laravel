<?php

namespace src\Lead\Infrastructure\Repositories;

use App\Models\Candidate as EloquentCandidateModel;
use Illuminate\Support\Facades\Cache;
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
    return Cache::remember("candidates", now()->addMinutes(10), function () {
      return $this->eloquentCandidateModel->get()->toArray();
    });
  }

  public function getAllLeadsByOwner(OwnerId $ownerId) {
    return Cache::remember("candidates_by_owner_{$ownerId}", now()->addMinutes(10), function () use ($ownerId) {
      return $this->eloquentCandidateModel->where("owner", $ownerId)->get()->toArray();
    });
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
