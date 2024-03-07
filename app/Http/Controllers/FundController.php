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
        $fundYearFilter = $request->input('year') ?? null;

        $filter = [
            'fundNameFilter' => $fundNameFilter,
            'fundManagerFilter' => $fundManagerFilter,
            'fundYearFilter' => $fundYearFilter
        ];

        $funds = $this->fundService->getFiltered($filter);

        return $this->sendResponse($funds, '');
    }

    public function store(Request $request)
    {
        $fund = $this->fundService->create($request->all());

        return $this->sendResponse($fund, 'Fund successfully created.');
    }

    public function show(string $id): JsonResponse
    {
        $fund = $this->fundService->get($id);

        return $this->sendResponse($fund, '');
    }

    public function update(Request $request, string $id)
    {
        $fund = $this->fundService->update($id, $request->all());
        //Update name, start_year, fund_manager_id
        //If receives alias, remove existing and add new ones
        //For companies, the same

        return $this->sendResponse($fund, 'Fund successfully updated');
    }

    public function destroy(string $id): JsonResponse
    {
        $this->fundService->delete($id);

        return $this->sendResponse([], 'Successfully removed.');
    }
}
