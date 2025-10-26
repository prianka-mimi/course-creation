<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Throwable;

class CourseController extends Controller
{
    public static string $route = 'course';

    /**
     * Display a listing of the resource.
     */
    final public function index(Request $request): View
    {
        $cms_content = [
            'module'       => 'Course',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('List'),
            'button_type'  => 'list',
            'button_title' => __('Create'),
            'button_url'   => route(self::$route . '.create'),
        ];

        $courses    = (new Course())->getCourseList($request);
        return view('backend.modules.course.index', compact('cms_content', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    final public function create(): View
    {
        $cms_content = [
            'module'       => 'Course',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Create'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.course.create', compact('cms_content'));
    }

    /**
     * Store a newly created resource in storage.
     */
    final public function store(StoreCourseRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Course())->storeCourse($request);
            success_alert(__('Course Created Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('Course_CREATED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->route(self::$route . '.index');
    }

    /**
     * Display the specified resource.
     */
    final public function show(Course $course): View
    {
        $cms_content = [
            'module'       => 'Course',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Details'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.course.show', compact('cms_content', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    final public function edit(Course $course): View
    {
        $cms_content = [
            'module'       => 'Course',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Edit'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.course.edit', compact('cms_content', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    final public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Course())->updateCourse($request, $course);
            success_alert(__('Course Updated Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('Course_UPDATED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->route(self::$route . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    final public function destroy(Course $course): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Course())->deleteCourse($course);
            success_alert(__('Course Deleted Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('Course_DELETED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->back();
    }
}
