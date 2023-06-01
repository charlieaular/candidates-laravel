<?php

namespace Src\Lead\Domain\ValueObjects;

use Stringable;

final class LeadId implements Stringable {
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
