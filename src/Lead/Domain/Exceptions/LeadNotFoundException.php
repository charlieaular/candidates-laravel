<?php

namespace Src\Lead\Domain\Exceptions;

use App\Responses\ErrorResponse;
use Exception;
use Illuminate\Http\Response;

class LeadNotFoundException extends Exception {

    public function render(){
        $error = "No lead found";
        return new ErrorResponse([$error], Response::HTTP_NOT_FOUND);
    }
}
