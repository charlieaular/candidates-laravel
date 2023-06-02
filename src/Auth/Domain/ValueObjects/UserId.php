<?php

namespace Src\Auth\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class UserId extends ValueObject {
  private $value;

  public function __construct(int $userId) {
    $this->value = $userId;
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
