@extends('backend.layouts.app')
@php
use App\Models\Course;
use App\Manager\Constants\GlobalConstants;
@endphp
@section('content')
    <div class="mt-4 row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($courses->isEmpty())
                            <tr style="background-color: #f2f2f2;">
                                <td colspan="12">
                                    <div class="text-center text-danger fs-6">
                                        {{ __('No course Data Found.') }}
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($courses as $course)
                            <tr>
                                <td class="text-center">
                                    <x-serial :serial="$loop->iteration" :collection="$courses" />
                                </td>
                                <td>
                                    <strong>{{ $course->title }}</strong>
                                </td>
                                <td>
                                    @if($course->category_objects->isNotEmpty())
                                        @foreach($course->category_objects as $cat)
                                            <span class="badge bg-info">{{ $cat->name }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm w-80px"
                                        style="background-color: {{ GlobalConstants::STATUS_LIST_COLOR[$course->status] }};border:none;">
                                        {{ Course::STATUS_LIST[$course->status] ?? '' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('course.show', $course->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('course.edit', $course->id) }}" class="mx-1 btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{ html()->form('DELETE', route('course.destroy', $course->id))->open() }}
                                        <button type="button" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {{ html()->form()->close() }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection
