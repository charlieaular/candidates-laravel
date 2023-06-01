<?php

namespace Src\Auth\Domain\ValueObjects;

use Stringable;

final class UserName implements Stringable {
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
}
