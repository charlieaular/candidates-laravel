<?php

namespace App\Responses;

final class MetaProperties {
  private $success;
  private $errors;

  public function __construct(bool $success, array $errors) {
    $this->success = $success;
    $this->errors = $errors;
  }

  public static function onSuccess() {
    return new self(
      success: true,
      errors: []
    );
  }

  public static function onError(array $errors) {
    return new self(
      success: false,
      errors: $errors
    );
  }



  public function toArray() {
    return [
      "success" => $this->success,
      "errors" => $this->errors
    ];
  }
}
