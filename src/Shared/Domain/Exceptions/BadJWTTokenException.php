<?php

namespace Src\Shared\Domain\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\Response;

class BadJWTTokenException extends Exception {
  private $errorMessage;

  public function __construct(string $errorMessage) {
    $this->errorMessage = $errorMessage;
  }

  public function render() {
    return new ErrorResponse([$this->errorMessage], Response::HTTP_UNAUTHORIZED);
  }
}
