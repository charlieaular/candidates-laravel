<?php

namespace Src\Auth\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\ValueObject;

final class UserName extends ValueObject {
  private $value;

  public function __construct(string $name) {
    $this->value = $name;
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
