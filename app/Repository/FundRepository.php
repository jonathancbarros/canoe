<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Fund;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FundRepository
{
    public function __construct(
        private readonly Fund $fund,
    ) {
    }

    public function create(array $data): array
    {
        $fund = $this->fund->create($data);

        return $this->formatFund($fund);
    }

    public function update($id, $data): Collection
    {
        $this->fund
            ->newQuery()
            ->where('id', '=', $id)
            ->update($data);

        return $this->get($id);
    }

    public function get($id): Collection
    {
         $fund = $this->fund
            ->newQuery()
            ->where('id', '=', $id)
            ->get();

         return $this->formatResult($fund);
    }

    public function getFiltered(array $filter): Collection
    {
        $funds = $this->fund->newQuery()->select();

        if ($filter['fundNameFilter']) {
            $funds->where('name', '=', $filter['fundNameFilter']);
        }

        if ($filter['fundManagerFilter']) {
            $funds->where('fund_manager_id', '=', $filter['fundManagerFilter']);
        }

        if ($filter['fundStartYearFilter']) {
            $funds->where('start_year', '=', $filter['fundStartYearFilter']);
        }

        return $this->formatResult($funds->get());
    }

    public function delete(string $id): void
    {
        $this->fund
            ->newQuery()
            ->where('id', '=', $id)
            ->delete();
    }

    public function isFundDuplicated($data): bool
    {
        return $this->fund
            ->newQuery()
            ->join('fund_aliases', 'funds.id', '=', 'fund_aliases.fund_id')
            ->where('fund_manager_id', '=', $data['fund_manager_id'])
            ->where(function ($query) use ($data) {
                $query
                    ->where('fund_aliases.name', '=', $data['name'])
                    ->orWhere('funds.name', '=', $data['name']);
            })
            ->exists();
    }

    public function getPossibleDuplicatedFunds(): array
    {
        return DB::select('
            SELECT f.name
            FROM funds f
            LEFT JOIN fund_aliases fa ON f.name = fa.name AND f.id != fa.fund_id
            GROUP BY f.name
            HAVING COUNT(f.name) > 1 OR COUNT(fa.name) >= 1;
        ');
    }

    private function formatResult(Collection $funds): Collection
    {
        return $funds->map(function ($fund) {
            return $this->formatFund($fund);
        });
    }

    private function formatFund(Fund $fund): array
    {
        return [
            'id' => $fund->id,
            'name' => $fund->name,
            'start_year' => $fund->start_year,
            'fund_manager' => [
                'id' => $fund->fundManager->id,
                'name' => $fund->fundManager->name,
            ],
            'companies' => $fund->companies->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                ];
            }),
            'aliases' => $fund->aliases->map(function ($alias) {
                return [
                    'id' => $alias->id,
                    'name' => $alias->name,
                ];
            })
        ];
    }
}
