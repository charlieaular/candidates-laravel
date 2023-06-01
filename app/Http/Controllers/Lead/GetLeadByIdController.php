<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Responses\SuccessResponse;
use Illuminate\Http\Request;
use Src\Lead\Infrastructure\Controllers\GetLeadByIdController as ControllersGetLeadByIdController;

class GetLeadByIdController extends Controller {

  private $getLeadByIdController;

  public function __construct(ControllersGetLeadByIdController $getLeadByIdController) {
    $this->getLeadByIdController = $getLeadByIdController;
  }

  public function __invoke(Request $request, int $leadId) {

    $data = $this->getLeadByIdController->__invoke((int) $leadId);

    return new SuccessResponse($data);
  }
}
