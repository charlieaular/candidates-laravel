<?php

namespace Src\Lead\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class LeadOwner extends ValueObject {
  private $value;

  public function __construct(int $leadOwner) {
    $this->value = $leadOwner;
  }

  public function value() {
    return $this->value;
  }

  public function __toString() {
    return $this->value;
  }

  public function jsonSerialize() {
    return $this->value;
  }
}
