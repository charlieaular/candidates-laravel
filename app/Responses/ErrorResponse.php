<?php

namespace App\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ErrorResponse implements Responsable {

  private $errors;
  private $statusCode;

  public function __construct(array $errors, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR) {
    $this->errors = $errors;
    $this->statusCode = $statusCode;
  }

  public function toResponse($request): JsonResponse {
    $metaProperties = MetaProperties::onError($this->errors);
    return new JsonResponse(
      data: [
        "meta" => $metaProperties->toArray(),
      ],
      status: $this->statusCode,
    );
  }
}
