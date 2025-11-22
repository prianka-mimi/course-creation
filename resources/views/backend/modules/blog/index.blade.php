@extends('backend.layouts.app')
@php
use App\Models\Blog;
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
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($blogs->isEmpty())
                            <tr style="background-color: #f2f2f2;">
                                <td colspan="12">
                                    <div class="text-center text-danger fs-6">
                                        {{ __('No blog Data Found.') }}
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($blogs as $blog)
                            <tr>
                                <td class="text-center">
                                    <x-serial :serial="$loop->iteration" :collection="$blogs" />
                                </td>
                                <td>
                                    <strong>{{ $blog->name }}</strong>
                                </td>
                                <td>
                                    <img class="img-table" src="{{ get_image(Blog::IMAGE_PATH . $blog->image) }}" alt="{{ $blog->image }}">
                                </td>
                                <td>
                                    <button class="btn btn-sm w-80px"
                                        style="background-color: {{ GlobalConstants::STATUS_LIST_COLOR[$blog->status] }};border:none;">
                                        {{ Blog::STATUS_LIST[$blog->status] ?? '' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('blog.edit', $blog->id) }}" class="mx-1 btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{ html()->form('DELETE', route('blog.destroy', $blog->id))->open() }}
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
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection
