<?php

namespace App\Models;

use App\Manager\Constants\GlobalConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Module extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function getModuleList(Request $request, array|null $columns = null)
    {
        return self::query()->paginate($request->input('per_page', GlobalConstants::DEFAULT_PAGINATION));
    }

    /**
     * @param Request $request
     * @return Model
     */
    final public function storeModule(Request $request): Model
    {
        return self::query()->create($this->prepareData($request));
    }

    public function updateModule(Request $request, Module $module)
    {
        return $module->update($this->prepareData($request, $module));
    }

    /**
     * @param Request $request
     * @param Module|null $module
     * @return array
     */
    private function prepareData(Request $request, Module $module = null): array
    {
        $data = [
            'course_id'         => $request->input('course_id'),
            'title'             => $request->input('title'),
            'status'            => $request->input('status') ?? self::STATUS_ACTIVE,
        ];

        return $data;
    }

    final public function deleteModule(Module $module): void
    {
        $module->delete();
    }

    final public function getModuleAssociated()
    {
        return self::query()
        ->where('status',self::STATUS_ACTIVE)
        ->pluck('title','id');
    }
}
