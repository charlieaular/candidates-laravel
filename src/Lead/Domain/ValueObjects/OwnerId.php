<?php

namespace Src\Lead\Domain\ValueObjects;

final class OwnerId {
  private $value;

  public function __construct(int $ownerId) {
    $this->value = $ownerId;
  }

  public function value(): int {
    return $this->value;
  }
}
