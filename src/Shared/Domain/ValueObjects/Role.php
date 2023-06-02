<?php

namespace Src\Shared\Domain\ValueObjects;

enum Role: string {
  case Manager = "manager";
  case Agent = "agent";
}
