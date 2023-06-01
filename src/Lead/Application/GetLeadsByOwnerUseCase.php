<?php

namespace Src\Lead\Application;

use Illuminate\Http\Request;
use Src\Lead\Domain\Contracts\LeadRepositoryContract;
use Src\Lead\Domain\ValueObjects\OwnerId;

final class GetLeadsByOwnerUseCase {

  private $repository;

  public function __construct(LeadRepositoryContract $repository) {
    $this->repository = $repository;
  }

  public function __invoke(int $ownerId) {

    $ownerIdVO = new OwnerId($ownerId);

    return $this->repository->getAllLeadsByOwner($ownerIdVO);
  }
}
