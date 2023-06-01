<?php

namespace Src\Lead\Domain\ValueObjects;

final class LeadId {
  private $value;

  public function __construct(int $leadId) {
    $this->value = $leadId;
  }

  public function value(): int {
    return $this->value;
  }

  public function __toString() {
    return $this->value;
  }
}
