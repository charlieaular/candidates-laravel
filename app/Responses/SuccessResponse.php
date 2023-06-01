<?php

namespace App\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SuccessResponse implements Responsable {

  private $data;
  private $statusCode;

  public function __construct(array $data, int $statusCode = Response::HTTP_OK) {
    $this->data = $data;
    $this->statusCode = $statusCode;
  }

  public function toResponse($request): JsonResponse {
    $metaProperties = MetaProperties::onSuccess();
    return new JsonResponse(
      data: [
        "meta" => $metaProperties->toArray(),
        "data" => $this->data
      ],
      status: $this->statusCode,
    );
  }
}
