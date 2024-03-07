<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\FundAlias;
use Illuminate\Support\Collection;

class FundAliasRepository
{
    public function __construct(
        private readonly FundAlias $fundAlias,
    ) {
    }

    public function create(array $data)
    {
        return $this->fundAlias->insert($data);
    }

    public function deleteByFundId($fundId): void
    {
        $this->fundAlias
            ->newQuery()
            ->where('fund_id', '=', $fundId)
            ->delete();
    }
}
