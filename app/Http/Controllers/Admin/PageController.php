<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Services\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function getPage()
    {
        return $this->pageService->getPage();
    }

    public function store(PageStoreRequest $request)
    {
        $this->pageService->store($request->validated());
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Page element created successfully.'
            ]);
        }
        return redirect()->back()->with('success', 'Page element created successfully.');
    }

    public function update(PageUpdateRequest $request)
    {
        $this->pageService->update($request->validated());
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Page element updated successfully.'
            ]);
        }
        return redirect()->back()->with('success', 'Page element updated successfully.');
    }

    public function destroy($id)
    {
        $this->pageService->destroy($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Page element deleted successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Page element deleted successfully.');
    }
}
