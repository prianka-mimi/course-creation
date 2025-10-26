<?php

namespace App\Manager\Course;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ModuleManager
{
    public function storeModule(Request $request): Model
    {
        return Module::query()->create($this->prepareData($request));
    }

    public function updateModule(Request $request, Module $module): bool
    {
        return $module->update($this->prepareData($request, $module));
    }

    private function prepareData(Request $request, Module $module = null): array
    {
        return [
            'course_id' => $request->input('course_id'),
            'title'     => $request->input('title'),
            'status'    => $request->input('status') ?? Module::STATUS_ACTIVE,
        ];
    }

    public function deleteModule(Module $module): void
    {
        $module->delete();
    }
}
