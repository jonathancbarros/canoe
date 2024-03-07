<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\FundCompany;

class FundCompanyRepository
{
    public function __construct(
        private readonly FundCompany $fundCompany,
    ) {
    }

    public function create(array $data): void
    {
        $this->fundCompany->insert($data);
    }

    public function deleteByFundId($fundId): void
    {
        $this->fundCompany
            ->newQuery()
            ->where('fund_id', '=', $fundId)
            ->delete();
    }
}
