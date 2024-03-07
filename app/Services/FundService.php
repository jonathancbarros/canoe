<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\FundRepository;
use Illuminate\Support\Collection;

class FundService
{
    public function __construct(
        private readonly FundRepository $fundRepository,
        private readonly FundAliasService $fundAliasService,
        private readonly FundCompanyService $fundCompanyService,
    ) {
    }

    public function get($id): Collection
    {
        return $this->fundRepository->get($id);
    }

    public function getFiltered($filter): Collection
    {
        return $this->fundRepository->getFiltered($filter);
    }

    public function delete($id): void
    {
        $this->fundRepository->delete($id);
    }

    public function create($data): array
    {
        return $this->fundRepository->create($data);
    }

    public function update($id, $data): Collection
    {
        if (!empty($data['companies'])) {
            $this->handleCompaniesUpdate($data['companies'], $id);
            unset($data['companies']);
        }

        if (!empty($data['aliases'])) {
            $this->handleAliasesUpdate($data['aliases'], $id);
            unset($data['aliases']);
        }

        return $this->fundRepository->update($id, $data);
    }

    private function handleCompaniesUpdate($companies, $fundId): void
    {
        $companies = array_map(function ($company) use ($fundId) {
            return [
                'fund_id' => $fundId,
                'company_id' => $company['id']
            ];
        }, $companies);

        $this->fundCompanyService->deleteByFundId($fundId);
        $this->fundCompanyService->create($companies);
    }

    private function handleAliasesUpdate($aliases, $fundId): void
    {
        $aliases = array_map(function ($alias) use ($fundId) {
            return [
                'fund_id' => $fundId,
                'name' => $alias['name']
            ];
        }, $aliases);

        $this->fundAliasService->deleteByFundId($fundId);
        $this->fundAliasService->create($aliases);
    }
}
