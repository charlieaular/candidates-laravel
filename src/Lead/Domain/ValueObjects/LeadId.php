<?php

namespace Src\Lead\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class LeadId extends ValueObject {
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

  public function jsonSerialize(): string {
    return $this->value;
  }
}
