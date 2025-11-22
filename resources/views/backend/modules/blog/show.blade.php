@extends('backend.layouts.app')
@php
    use App\Models\Blog;
    use App\Manager\Constants\GlobalConstants;
    use App\Manager\ImageUploadManager;
@endphp
@section('content')
    <div class="mt-4 row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title ?? '' }}</h5>

                    <div class="text-center mt-2">
                        <img class="img-fluid" src="{{ get_image(Blog::IMAGE_PATH . $blog->image) }}"
                            alt="{{ $blog->image }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-md table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th style="width: 20%;">Status</th>
                        <td>
                            <span class="badge"
                                style="background-color: {{ GlobalConstants::STATUS_LIST_COLOR[$blog->status] }};">
                                {{ Blog::STATUS_LIST[$blog->status] ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $blog->short_description }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $blog->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $blog->created_at != $blog->updated_at ? $blog->updated_at->toDayDateTimeString() : 'Not updated yet' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <div class="d-flex justify-content-start align-items-center">
                <a href="{{ route('blog.index') }}">
                    <x-show-back-button />
                </a>
            </div>
        </div>
    </div>
@endsection
