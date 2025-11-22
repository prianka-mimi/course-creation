<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Manager\ImageUploadManager;
use Illuminate\Database\Eloquent\Model;
use App\Manager\Constants\GlobalConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public const IMAGE_PATH = 'uploads/blog/';

    public function getBlogList(Request $request, array|null $columns = null)
    {
        return self::query()->paginate($request->input('per_page', GlobalConstants::DEFAULT_PAGINATION));
    }

    /**
     * @param Request $request
     * @return Model
     */
    final public function storeBlog(Request $request): Model
    {
        return self::query()->create($this->prepareData($request));
    }

    public function updateBlog(Request $request, Blog $blog)
    {
        return $blog->update($this->prepareData($request, $blog));
    }

    /**
     * @param Request $request
     * @param Blog|null $blog
     * @return array
     */
    private function prepareData(Request $request, Blog $blog = null): array
    {
        $data = [
            'name'              => $request->input('name'),
            'description'       => $request->input('description'),
            'status'            => $request->input('status') ?? self::STATUS_ACTIVE,
        ];

        if ($request->hasFile('image')) {
            if ($blog && $blog->image) {
                ImageUploadManager::deletePhoto(self::IMAGE_PATH . $blog->image);
            }
            $data['image'] = (new ImageUploadManager())
                ->file($request->file('image'))
                ->name($request->input('name').time())
                ->path(self::IMAGE_PATH)
                ->auto_size()
                ->upload();
        }

        return $data;
    }

    final public function deleteBlog(Blog $blog): void
    {
        if ($blog->image) {
            ImageUploadManager::deletePhoto(self::IMAGE_PATH . $blog->image);
        }

        $blog->delete();
    }

    final public function getBlogAssociated()
    {
        return self::query()
        ->where('status',self::STATUS_ACTIVE)
        ->pluck('name','id');
    }
}
