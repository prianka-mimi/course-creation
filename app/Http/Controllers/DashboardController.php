<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    final public function index(): View
    {
        $cms_content      = [
            'active_title'    => __('Dashboard'),
        ];

        $totalCourses = (new Course())->getDashboardCounts()['total'];
        $activeCourses = (new Course())->getDashboardCounts()['active'];
        $inactiveCourses = (new Course())->getDashboardCounts()['inactive'];

        $totalCategories = (new Category())->getDashboardCounts()['total'];
        $activeCategories = (new Category())->getDashboardCounts()['active'];
        $inactiveCategories = (new Category())->getDashboardCounts()['inactive'];

        $totalUsers = (new User())->getDashboardCounts()['total'];
        $activeUsers = (new User())->getDashboardCounts()['active'];
        $inactiveUsers = (new User())->getDashboardCounts()['inactive'];

        $courses = Course::latest()->take(5)->get();

        return view('backend.modules.index', compact('cms_content', 'totalCourses', 'activeCourses', 'inactiveCourses', 'totalCategories', 'activeCategories', 'inactiveCategories', 'totalUsers', 'activeUsers', 'inactiveUsers', 'courses'));
    }

    final public function userList(Request $request)
    {
        $users = (new User())->getUserList($request);
        return view('backend.modules.user-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
