<?php


namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLeadRequest;
use App\Responses\SuccessResponse;
use Illuminate\Http\Response;
use Src\Lead\Infrastructure\Controllers\CreateLeadController as ControllersCreateLeadController;

class CreateLeadController extends Controller {

  private $createLeadController;

  public function __construct(ControllersCreateLeadController $createLeadController) {
    $this->createLeadController = $createLeadController;
  }

  public function __invoke(CreateLeadRequest $request) {
    $name = $request->input("name");
    $source = $request->input("source");
    $owner = $request->input("owner");
    $createdBy = auth()->user()->id;

    $data = $this->createLeadController->__invoke($name, $source, (int) $owner, $createdBy);
    return new SuccessResponse($data, Response::HTTP_CREATED);
  }
}
