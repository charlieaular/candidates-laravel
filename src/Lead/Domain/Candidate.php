<?php

namespace Src\Lead\Domain;

use Src\Lead\Domain\ValueObjects\LeadCreatedBy;
use Src\Lead\Domain\ValueObjects\LeadName;
use Src\Lead\Domain\ValueObjects\LeadOwner;
use Src\Lead\Domain\ValueObjects\LeadSource;

final class Candidate {
  private $leadName;
  private $leadOwner;
  private $leadSource;
  private $leadCreatedBy;

  public function __construct(LeadName $leadName, LeadOwner $leadOwner, LeadSource $leadSource, LeadCreatedBy $leadCreatedBy) {

    $this->leadName = $leadName;
    $this->leadOwner = $leadOwner;
    $this->leadSource = $leadSource;
    $this->leadCreatedBy = $leadCreatedBy;
  }

  public function leadName(): LeadName {
    return $this->leadName;
  }

  public function leadOwner(): LeadOwner {
    return $this->leadOwner;
  }

  public function leadSource(): LeadSource {
    return $this->leadSource;
  }

  public function leadCreatedBy(): LeadCreatedBy {
    return $this->leadCreatedBy;
  }

  public static function create(LeadName $leadName, LeadOwner $leadOwner, LeadSource $leadSource, LeadCreatedBy $leadCreatedBy): Candidate {
    $lead = new self(leadName: $leadName, leadOwner: $leadOwner, leadSource: $leadSource, leadCreatedBy: $leadCreatedBy);
    return $lead;
  }
}
