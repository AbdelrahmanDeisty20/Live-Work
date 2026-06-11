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
            'name' => 'required|string|max:255'
        ]);

        $skill = $this->skillService->storeSkill($request->only('name'));

        return response()->json([
            'status' => 'success',
            'message' => 'Skill successfully registered.',
            'data' => $skill
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $skill = $this->skillService->updateSkill($id, $request->only('name'));

        return response()->json([
            'status' => 'success',
            'message' => 'Skill successfully updated.',
            'data' => $skill
        ]);
    }

    public function destroy($id)
    {
        $this->skillService->deleteSkill($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Skill successfully decommissioned.'
            ]);
        }

        return redirect()->back()->with('success', 'Skill successfully decommissioned.');
    }
}
