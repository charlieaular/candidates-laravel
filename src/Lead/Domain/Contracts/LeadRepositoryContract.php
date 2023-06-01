<?php

namespace Src\Lead\Domain\Contracts;

use Src\Lead\Domain\ValueObjects\OwnerId;

interface LeadRepositoryContract {
  public function getAllLeads();
  
  public function getAllLeadsByOwner(OwnerId $ownerId );
  
}