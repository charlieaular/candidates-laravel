<?php

namespace Src\Auth\Domain\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\Response;

class DeactivatedUserException extends Exception {
    private $userName;

    public function __construct(string $userName) {
        $this->userName = $userName;
    }

    public function render(){
        $error = "User {$this->userName} is deactivated";
        return new ErrorResponse([$error], Response::HTTP_UNAUTHORIZED);
    }
}
