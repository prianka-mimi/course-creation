<?php

namespace App\Manager\Course;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ContentManager
{
    public function storeContent(Request $request): Model
    {
        return Content::query()->create($this->prepareData($request));
    }

    public function updateContent(Request $request, Content $content): bool
    {
        return $content->update($this->prepareData($request, $content));
    }

    private function prepareData(Request $request, Content $content = null): array
    {
        return [
            'module_id'         => $request->input('module_id'),
            'title'             => $request->input('title'),
            'video_source_type' => $request->input('video_source_type'),
            'video_url'         => $request->input('video_url'),
            'video_length'      => $request->input('video_length'),
            'status'            => $request->input('status') ?? Content::STATUS_ACTIVE,
        ];
    }

    public function deleteContent(Content $content): void
    {
        $content->delete();
    }
}
