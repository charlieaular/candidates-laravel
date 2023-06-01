<?php

namespace Src\Lead\Domain\ValueObjects;

use Stringable;

final class OwnerId implements Stringable {
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
}
