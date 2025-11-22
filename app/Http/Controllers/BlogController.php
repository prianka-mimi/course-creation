<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Throwable;

class BlogController extends Controller
{
    public static string $route = 'blog';

    /**
     * Display a listing of the resource.
     */
    final public function index(Request $request): View
    {
        $cms_content = [
            'module'       => 'Blog',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('List'),
            'button_type'  => 'list',
            'button_title' => __('Create'),
            'button_url'   => route(self::$route . '.create'),
        ];

        $blogs    = (new Blog())->getBlogList($request);
        return view('backend.modules.blog.index', compact('cms_content', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    final public function create(): View
    {
        $cms_content = [
            'module'       => 'Blog',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Create'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.blog.create', compact('cms_content'));
    }

    /**
     * Store a newly created resource in storage.
     */
    final public function store(StoreBlogRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Blog())->storeBlog($request);
            success_alert(__('Blog Created Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('Blog_CREATED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->route(self::$route . '.index');
    }

    /**
     * Display the specified resource.
     */
    final public function show(Blog $blog): View
    {
        $cms_content = [
            'module'       => 'Blog',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Details'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.blog.show', compact('cms_content', 'blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    final public function edit(Blog $blog): View
    {
        $cms_content = [
            'module'       => 'Blog',
            'module_url'   => route(self::$route . '.index'),
            'active_title' => __('Edit'),
            'button_type'  => 'list',
            'button_title' => __('List'),
            'button_url'   => route(self::$route . '.index'),
        ];

        return view('backend.modules.blog.edit', compact('cms_content', 'blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    final public function update(UpdateBlogRequest $request, Blog $blog):RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Blog())->updateBlog($request, $blog);
            success_alert(__('Blog Updated Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('Blog_UPDATED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->route(self::$route . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    final public function destroy(Blog $blog): RedirectResponse
    {
        try {
            DB::beginTransaction();
            (new Blog())->deleteBlog($blog);
            success_alert(__('Blog Deleted Successfully'));
            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            app_error_log('Blog_DELETED_FAILED', $throwable, 'error');
            failed_alert($throwable->getMessage());
            return redirect()->back();
        }

        return redirect()->back();
    }
}
