@extends('backend.layouts.app')
@php
use App\Models\Course;
use App\Manager\Constants\GlobalConstants;
@endphp
@section('content')
    <div class="mt-4 row justify-content-center">
        <div class="col-md-8">
            <table class="table table-md table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge" style="background-color: {{ GlobalConstants::STATUS_LIST_COLOR[$course->status] }};">
                                {{ Course::STATUS_LIST[$course->status] ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $course->title }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $course->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                    <th>Updated At</th>
                        <td>{{ $course->created_at != $course->updated_at ? $course->updated_at->toDayDateTimeString() : 'Not updated yet' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <div class="d-flex justify-content-start align-items-center">
                <a href="{{ route('course.index') }}">
                   <x-show-back-button />
                </a>
            </div>
        </div>
    </div>
@endsection
