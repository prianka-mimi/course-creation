<?php

namespace App\Models;

use App\Manager\Constants\GlobalConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Content extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getContentList(Request $request, array|null $columns = null)
    {
        return self::query()->paginate($request->input('per_page', GlobalConstants::DEFAULT_PAGINATION));
    }

    /**
     * @param Request $request
     * @return Model
     */
    final public function storeContent(Request $request): Model
    {
        return self::query()->create($this->prepareData($request));
    }

    public function updateContent(Request $request, Content $content)
    {
        return $content->update($this->prepareData($request, $content));
    }

    /**
     * @param Request $request
     * @param Content|null $content
     * @return array
     */
    private function prepareData(Request $request, Content $content = null): array
    {
        $data = [
            'module_id'         => $request->input('module_id'),
            'title'             => $request->input('title'),
            'video_source_type' => $request->input('video_source_type'),
            'video_url'         => $request->input('video_url'),
            'video_length'      => $request->input('video_length'),
            'status'            => $request->input('status') ?? self::STATUS_ACTIVE,
        ];

        return $data;
    }

    final public function deleteContent(Content $content): void
    {
        $content->delete();
    }

    final public function getContentAssociated()
    {
        return self::query()
        ->where('status',self::STATUS_ACTIVE)
        ->pluck('title','id');
    }
}
