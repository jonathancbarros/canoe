<?php

namespace App\Http\Controllers;

use App\Services\FundService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function __construct(
        private readonly FundService $fundService,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $fundNameFilter = $request->input('name') ?? null;
        $fundManagerFilter = $request->input('manager') ?? null;
        $fundStartYearFilter = $request->input('start_year') ?? null;

        $filter = [
            'fundNameFilter' => $fundNameFilter,
            'fundManagerFilter' => $fundManagerFilter,
            'fundStartYearFilter' => $fundStartYearFilter
        ];

        $funds = $this->fundService->getFiltered($filter);

        return $this->sendResponse($funds);
    }

    public function store(Request $request): JsonResponse
    {
        $fund = $this->fundService->create($request->all());

        return $this->sendResponse($fund, 'Fund successfully created.');
    }

    public function show(string $id): JsonResponse
    {
        $fund = $this->fundService->get($id);

        return $this->sendResponse($fund);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $fund = $this->fundService->update($id, $request->all());

        return $this->sendResponse($fund, 'Fund successfully updated');
    }

    public function destroy(string $id): JsonResponse
    {
        $this->fundService->delete($id);

        return $this->sendResponse([], 'Successfully removed.');
    }

    public function getPossibleDuplicatedFunds(): JsonResponse
    {
        return $this->sendResponse($this->fundService->getPossibleDuplicatedFunds(), '');
    }
}
