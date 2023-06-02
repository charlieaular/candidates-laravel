<?php

namespace Src\Lead\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class LeadCreatedBy extends ValueObject {
  private $value;

  public function __construct(int $leadCreatedBy) {
    $this->value = $leadCreatedBy;
  }

  public function value(): int {
    return $this->value;
  }

  public function __toString() {
    return $this->value;
  }

  public function jsonSerialize(): int {
    return $this->value;
  }
}
