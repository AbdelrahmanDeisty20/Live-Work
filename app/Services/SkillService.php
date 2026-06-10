<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\Content;

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
        $skill->contents()->delete();
        $skill->delete();
        return true;
    }

    public function getSkillContents($skillId)
    {
        $skill = Skill::findOrFail($skillId);
        return $skill->contents;
    }

    public function storeContent($data)
    {
        return Content::create($data);
    }

    public function updateContent($id, $data)
    {
        $content = Content::findOrFail($id);
        $content->update($data);
        return $content;
    }

    public function deleteContent($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return true;
    }
}
