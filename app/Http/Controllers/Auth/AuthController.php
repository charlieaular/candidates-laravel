<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Responses\ErrorResponse;
use App\Responses\SuccessResponse;
use Illuminate\Http\Request;
use Src\Auth\Infrastructure\LoginController;

class AuthController extends Controller {

  private $loginController;

  public function __construct(LoginController $loginController) {
    $this->loginController = $loginController;
  }

  public function __invoke(Request $request) {
      $token = $this->loginController->__invoke($request);
      $data = [
        "token" => $token,
        "minutes_to_expire" => env("JWT_TTL")
      ];

      return new SuccessResponse($data);
  }
}
