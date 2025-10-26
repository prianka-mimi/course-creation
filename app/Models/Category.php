<?php

namespace App\Models;

use App\Manager\Constants\GlobalConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public function getCategoryList(Request $request, array|null $columns = null)
    {
        return self::query()->paginate($request->input('per_page', GlobalConstants::DEFAULT_PAGINATION));
    }

    /**
     * @param Request $request
     * @return Model
     */
    final public function storeCategory(Request $request): Model
    {
        return self::query()->create($this->prepareData($request));
    }

    public function updateCategory(Request $request, Category $category)
    {
        return $category->update($this->prepareData($request, $category));
    }

    /**
     * @param Request $request
     * @param Category|null $category
     * @return array
     */
    private function prepareData(Request $request, Category $category = null): array
    {
        $data = [
            'name'              => $request->input('name'),
            'status'            => $request->input('status') ?? self::STATUS_ACTIVE,
        ];

        return $data;
    }

    final public function deleteCategory(Category $category): void
    {
        $category->delete();
    }

    final public function getCategoryAssociated()
    {
        return self::query()
        ->where('status',self::STATUS_ACTIVE)
        ->pluck('name','id');
    }
}
