<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorksStoreRequest;
use App\Http\Requests\Admin\WorksUpdateRequest;
use App\Services\WorkService;

class WorkController extends Controller
{
    protected $workService;

    public function __construct(WorkService $workService)
    {
        $this->workService = $workService;
    }
    public function getAllWorks()
    {
        return $this->workService->getAllWorks();
    }
    public function storeWork(WorksStoreRequest $request)
    {
        return $this->workService->storeWork($request->validated());
    }
    public function updateWork(WorksUpdateRequest $request)
    {
        return $this->workService->updateWork($request->validated());
    }
    public function deleteWork($id)
    {
        return $this->workService->deleteWork($id);
    }
}
