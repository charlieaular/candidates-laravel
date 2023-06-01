<?php

namespace Src\Auth\Domain\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\Response;

class WrongPasswordException extends Exception {
    private $userName;

    public function __construct(string $userName) {
        $this->userName = $userName;
    }

    public function render(){
        $error = "Password incorrect for user: {$this->userName}";
        return new ErrorResponse([$error], Response::HTTP_UNAUTHORIZED);
    }
}
