<?php

namespace Src\Lead\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class LeadName extends ValueObject {
  private $value;

  public function __construct(string $leadName) {
    $this->value = $leadName;
  }

  public function value(): string {
    return $this->value;
  }

  public function __toString() {
    return $this->value;
  }

  public function jsonSerialize(): string {
    return $this->value;
  }
  
}
