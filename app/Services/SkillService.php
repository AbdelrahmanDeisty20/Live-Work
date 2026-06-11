<?php

namespace App\Services;

use App\Models\Skill;

class SkillService
{
    public function storeSkill($data)
    {
        return Skill::create($data);
    }

    public function updateSkill($id, $data)
    {
        $skill = Skill::findOrFail($id);
        $skill->update($data);
        return $skill;
    }

    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return true;
    }
}
