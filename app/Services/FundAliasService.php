<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\FundAliasRepository;
use Illuminate\Support\Collection;

class FundAliasService
{
    public function __construct(
        private readonly FundAliasRepository $fundAliasRepository,
    ) {
    }

    public function create($data)
    {
        return $this->fundAliasRepository->create($data);
    }

    public function deleteByFundId($fundId): void
    {
        $this->fundAliasRepository->deleteByFundId($fundId);
    }

}
