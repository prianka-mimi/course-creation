@extends('backend.layouts.app')
@php
    use App\Models\Category;
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
                            <span class="badge" style="background-color: {{ GlobalConstants::STATUS_LIST_COLOR[$category->status] }};">
                                {{ Category::STATUS_LIST[$category->status] ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                    <th>Updated At</th>
                        <td>{{ $category->created_at != $category->updated_at ? $category->updated_at->toDayDateTimeString() : 'Not updated yet' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <div class="d-flex justify-content-start align-items-center">
                <a href="{{ route('category.index') }}">
                   <x-show-back-button />
                </a>
            </div>
        </div>
    </div>
@endsection
