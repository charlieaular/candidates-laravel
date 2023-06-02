<?php

namespace Src\Lead\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class OwnerId extends ValueObject {
  private $value;

  public function __construct(int $ownerId) {
    $this->value = $ownerId;
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
