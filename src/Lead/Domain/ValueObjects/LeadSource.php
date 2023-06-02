<?php

namespace Src\Lead\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class LeadSource extends ValueObject {
  private $value;

  public function __construct(string $leadSource) {
    $this->value = $leadSource;
  }

  public function value() {
    return $this->value;
  }

  public function __toString() {
    return $this->value;
  }

  public function jsonSerialize(): string {
    return $this->value;
  }
}
