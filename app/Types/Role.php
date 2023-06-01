<?php

namespace App\Types;

enum Role: string {
  case Manager = "manager";
  case Agent = "agent";
}
