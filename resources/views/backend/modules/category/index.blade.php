@extends('backend.layouts.app')
@php
    use App\Models\Category;
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
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categorys->isEmpty())
                            <tr style="background-color: #f2f2f2;">
                                <td colspan="12">
                                    <div class="text-center text-danger fs-6">
                                        {{ __('No category Data Found.') }}
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($categorys as $category)
                            <tr>
                                <td class="text-center">
                                    <x-serial :serial="$loop->iteration" :collection="$categorys" />
                                </td>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                    <p class="text-success small">{{ $category->slug }}</p>
                                </td>
                                <td>
                                    <button class="btn btn-sm w-80px"
                                        style="background-color: {{ GlobalConstants::STATUS_LIST_COLOR[$category->status] }};border:none;">
                                        {{ Category::STATUS_LIST[$category->status] ?? '' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('category.edit', $category->id) }}" class="mx-1 btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{ html()->form('DELETE', route('category.destroy', $category->id))->open() }}
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
                {{ $categorys->links() }}
            </div>
        </div>
    </div>
@endsection
