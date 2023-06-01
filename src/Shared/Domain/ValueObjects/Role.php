<?php

namespace App\Types;
namespace Src\Shared\Domain\ValueObject;

enum Role: string {
  case Manager = "manager";
  case Agent = "agent";
}
