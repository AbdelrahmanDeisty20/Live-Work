<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SkillService;

class SkillController extends Controller
{
    protected $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $skill = $this->skillService->storeSkill($request->only('title'));

        return response()->json([
            'status' => 'success',
            'message' => 'Skill category successfully initialized.',
            'data' => $skill
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $skill = $this->skillService->updateSkill($id, $request->only('title'));

        return response()->json([
            'status' => 'success',
            'message' => 'Skill category successfully updated.',
            'data' => $skill
        ]);
    }

    public function destroy($id)
    {
        $this->skillService->deleteSkill($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Skill category and all its contents decommissioned.'
            ]);
        }

        return redirect()->back()->with('success', 'Skill category and all its contents decommissioned.');
    }

    public function getContents($skillId)
    {
        $contents = $this->skillService->getSkillContents($skillId);

        return response()->json([
            'status' => 'success',
            'data' => $contents
        ]);
    }

    public function storeContent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'skill_id' => 'required|exists:skills,id'
        ]);

        $content = $this->skillService->storeContent($request->only('title', 'value', 'percentage', 'skill_id'));

        return response()->json([
            'status' => 'success',
            'message' => 'Proficiency node added to stack.',
            'data' => $content
        ]);
    }

    public function updateContent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100'
        ]);

        $content = $this->skillService->updateContent($id, $request->only('title', 'value', 'percentage'));

        return response()->json([
            'status' => 'success',
            'message' => 'Proficiency node details updated.',
            'data' => $content
        ]);
    }

    public function destroyContent($id)
    {
        $this->skillService->deleteContent($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Proficiency node deleted.'
        ]);
    }
}
