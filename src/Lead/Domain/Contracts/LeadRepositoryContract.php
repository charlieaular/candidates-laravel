<?php

namespace Src\Lead\Domain\Contracts;

use Src\Lead\Domain\Candidate;
use Src\Lead\Domain\ValueObjects\LeadId;
use Src\Lead\Domain\ValueObjects\OwnerId;

interface LeadRepositoryContract {
  public function getAllLeads();

  public function getAllLeadsByOwner(OwnerId $ownerId);

  public function getAllLeadById(LeadId $leadId);

  public function createLead(Candidate $candidate);
}
