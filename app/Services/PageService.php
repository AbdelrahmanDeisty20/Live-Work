<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PageService
{
    public function getPage()
    {
        $page = Page::all();
        if ($page->isEmpty()) {
            return response([
                'status' => true,
                'message' => 'Page fetched successfully',
                'data' => $page
            ], 200);
        }
    }

    public function store(array $data)
    {
        // إذا النوع صورة، ارفع الملف واحفظ المسار
        if (isset($data['type']) && $data['type'] === 'image' && isset($data['value']) && $data['value'] instanceof UploadedFile) {
            $data['value'] = $data['value']->store('pages', 'public');
        }

        $page = Page::create($data);
        return response([
            'status' => true,
            'message' => 'Page created successfully',
            'data' => $page
        ], 200);
    }

    public function update(array $data)
    {
        $page = Page::where('id', $data['id'])->first();

        // إذا النوع صورة وتم رفع ملف جديد
        if (isset($data['type']) && $data['type'] === 'image' && isset($data['value']) && $data['value'] instanceof UploadedFile) {
            // احذف الصورة القديمة إذا كانت موجودة
            if ($page->value && Storage::disk('public')->exists($page->value)) {
                Storage::disk('public')->delete($page->value);
            }
            $data['value'] = $data['value']->store('pages', 'public');
        } elseif (isset($data['type']) && $data['type'] === 'image' && empty($data['value'])) {
            // إذا لم يتم رفع صورة جديدة، احتفظ بالقديمة
            unset($data['value']);
        }

        $page->update($data);
        return response([
            'status' => true,
            'message' => 'Page updated successfully',
            'data' => $page
        ], 200);
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        // احذف الصورة من الـ storage إذا كان النوع image
        if ($page->type === 'image' && $page->value && Storage::disk('public')->exists($page->value)) {
            Storage::disk('public')->delete($page->value);
        }

        $page->delete();
    }
}

