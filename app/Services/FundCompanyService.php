<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\FundCompanyRepository;

class FundCompanyService
{
    public function __construct(
        private readonly FundCompanyRepository $fundCompanyRepository,
    ) {
    }

    public function create($data): void
    {
        $this->fundCompanyRepository->create($data);
    }

    public function deleteByFundId($fundId): void
    {
        $this->fundCompanyRepository->deleteByFundId($fundId);
    }
}
