<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Responses\ErrorResponse;
use App\Responses\SuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Lead\Infrastructure\Controllers\GetLeadsByOwnerControllers;
use Src\Lead\Infrastructure\Controllers\GetLeadsControllers;
use Src\Shared\Domain\ValueObjects\Role;

class GetLeadsController extends Controller {

  private $getLeadsControllers;
  private $getLeadsByOwnerControllers;

  public function __construct(GetLeadsControllers $getLeadsControllers, GetLeadsByOwnerControllers $getLeadsByOwnerControllers) {
    $this->getLeadsControllers = $getLeadsControllers;
    $this->getLeadsByOwnerControllers = $getLeadsByOwnerControllers;
  }

  public function __invoke(Request $request) {

      $currentUser = Auth::user();

      $isCurrentUserManager = Role::from($currentUser->role) == Role::Manager;

      $data = $isCurrentUserManager 
        ? $this->getLeadsControllers->__invoke() 
        : $this->getLeadsByOwnerControllers->__invoke($currentUser->id);

      return new SuccessResponse($data);
  }
}
