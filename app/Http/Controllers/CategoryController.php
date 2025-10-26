<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryController extends Controller
{
    public static string $route = 'category';

    /**
     * Display a listing of the resource.
     */
    final public function index(Request $request): View
    {
        $cms_content = [
            'module'       => 'Category',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('List'),
            'button_type'  => 'list',
            'button_title' => __('Create'),
            'button_url'   => route(self::$route . '.create'),
        ];

        $categorys    = (new Category())->getCategoryList($request);
        return view('backend.modules.category.index', compact('cms_content', 'categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    final public function create(): View
    {
        $cms_content = [
            'module'       => 'Category',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Create'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.category.create', compact('cms_content'));
    }

    /**
     * Store a newly created resource in storage.
     */
    final public function store(StoreCategoryRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Category())->storeCategory($request);
            success_alert(__('Category Created Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('CATEGORY_CREATED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->route(self::$route . '.index');
    }

    /**
     * Display the specified resource.
     */
    final public function show(Category $category): View
    {
        $cms_content = [
            'module'       => 'Category',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Details'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.category.show', compact('cms_content', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    final public function edit(Category $category): View
    {
        $cms_content = [
            'module'       => 'Category',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Edit'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.category.edit', compact('cms_content', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    final public function update(UpdateCategoryRequest $request, Category $category):RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Category())->updateCategory($request, $category);
            success_alert(__('Category Updated Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('CATEGORY_UPDATED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->route(self::$route . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    final public function destroy(Category $category): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Category())->deleteCategory($category);
            success_alert(__('Category Deleted Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('CATEGORY_DELETED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->back();
    }
}
