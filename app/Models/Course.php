<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Manager\Constants\GlobalConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Removed category cast as we're using pivot table now

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function getCategoryObjectsAttribute()
    {
        return $this->categories;
    }

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    ];

    public function getCourseList(Request $request, array|null $columns = null)
    {
        return self::query()->paginate($request->input('per_page', GlobalConstants::DEFAULT_PAGINATION));
    }

    /**
     * @param Request $request
     * @return Model
     */
    final public function storeCourse(Request $request): Model
    {
        return self::query()->create($this->prepareData($request));
    }

    public function updateCourse(Request $request, Course $course)
    {
        return $course->update($this->prepareData($request, $course));
    }

    /**
     * @param Request $request
     * @param Course|null $course
     * @return array
     */
    private function prepareData(Request $request, Course $course = null): array
    {
        $data           = [
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'feature_video' => $request->input('feature_video'),
            'status'        => $request->input('status') ?? self::STATUS_ACTIVE,
        ];

        return $data;
    }

    final public function deleteCourse(Course $course): void
    {
        $course->delete();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
