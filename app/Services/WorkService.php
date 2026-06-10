<?php

namespace App\Services;

use App\Models\Work;
use App\Models\Tecknical;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WorkService
{
    public function getAllWorks()
    {
        return Work::all();
    }

    public function storeWork(array $data)
    {
        // رفع الصورة إذا وُجدت
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $data['image']->store('works', 'public');
        }

        // استخرج الـ tags قبل إنشاء الـ work
        $tags = isset($data['tags']) ? $data['tags'] : null;
        unset($data['tags']);

        $work = Work::create($data);

        // احفظ كل tag كـ Tecknical record
        if ($tags) {
            foreach (array_filter(array_map('trim', explode(',', $tags))) as $tag) {
                Tecknical::create(['name' => $tag, 'work_id' => $work->id]);
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Project created successfully.',
            'data'    => $work->load('tecknicals'),
        ]);
    }

    public function updateWork(array $data)
    {
        $work = Work::findOrFail($data['id']);

        // رفع صورة جديدة إذا وُجدت
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            if ($work->image && Storage::disk('public')->exists($work->image)) {
                Storage::disk('public')->delete($work->image);
            }
            $data['image'] = $data['image']->store('works', 'public');
        } else {
            unset($data['image']);
        }

        // تحديث الـ tags
        $tags = isset($data['tags']) ? $data['tags'] : null;
        unset($data['tags']);

        $work->update($data);

        if ($tags !== null) {
            // احذف الـ tags القديمة وأضف الجديدة
            $work->tecknicals()->delete();
            foreach (array_filter(array_map('trim', explode(',', $tags))) as $tag) {
                Tecknical::create(['name' => $tag, 'work_id' => $work->id]);
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Project updated successfully.',
            'data'    => $work->load('tecknicals'),
        ]);
    }

    public function deleteWork($id)
    {
        $work = Work::findOrFail($id);

        // حذف الصورة من الـ storage
        if ($work->image && Storage::disk('public')->exists($work->image)) {
            Storage::disk('public')->delete($work->image);
        }

        $work->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Project deleted successfully.',
        ]);
    }
}

