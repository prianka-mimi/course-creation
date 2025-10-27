@extends('backend.layouts.app')

@php
    use App\Models\Course;
@endphp

@section('content')
<div class="mt-4 row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ $course->title }}</h4>
                <span class="badge fs-6" style="background-color: {{ App\Manager\Constants\GlobalConstants::STATUS_LIST_COLOR[$course->status] }};">
                    {{ Course::STATUS_LIST[$course->status] ?? '' }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-subtitle mb-2 text-muted">Course Details</h5>
                        <p class="card-text"><strong>Description:</strong> {{ $course->description ?? 'N/A' }}</p>
                        <div>
                            <strong>Categories:</strong>
                            @if($course->category_objects->isNotEmpty())
                                @foreach($course->category_objects as $cat)
                                    <span class="badge bg-info">{{ $cat->name }}</span>
                                @endforeach
                            @else
                                <span>N/A</span>
                            @endif
                        </div>
                        <hr>
                        <p class="card-text"><small class="text-muted">Created: {{ $course->created_at->toDayDateTimeString() }}</small></p>
                        <p class="card-text"><small class="text-muted">Last Updated: {{ $course->updated_at->toDayDateTimeString() }}</small></p>
                    </div>
                    <div class="col-md-4">
                        @if($course->feature_video)
                            <h5 class="card-subtitle mb-2 text-muted">Featured Video</h5>
                            <video controls width="100%">
                                <source src="{{ asset('storage/' . $course->feature_video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <h4 class="text-center">Modules</h4>
        <div class="accordion" id="modulesAccordion">
            @forelse($course->modules as $module)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $module->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $module->id }}" aria-expanded="false" aria-controls="collapse{{ $module->id }}">
                            <strong>{{ $module->title }}</strong>
                        </button>
                    </h2>
                    <div id="collapse{{ $module->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $module->id }}" data-bs-parent="#modulesAccordion">
                        <div class="accordion-body">
                            @if($module->contents->isNotEmpty())
                                <ul class="list-group">
                                    @foreach($module->contents as $content)
                                        <li class="list-group-item">
                                            <h5>{{ $content->title }} <span class="badge bg-secondary">{{ ucfirst($content->type) }}</span></h5>
                                            @switch($content->type)
                                                @case('text')
                                                    <p>{{ $content->content_text }}</p>
                                                    @break
                                                @case('image')
                                                    @if($content->image_path)
                                                        <img src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->title }}" class="img-fluid mt-2" style="max-height: 200px;">
                                                    @endif
                                                    @break
                                                @case('link')
                                                    <a href="{{ $content->link_url }}" target="_blank">{{ $content->link_url }}</a>
                                                    @break
                                                @case('video')
                                                    <p><strong>Source:</strong> {{ $content->video_source_type ?? 'N/A' }}</p>
                                                    <p><strong>URL:</strong> <a href="{{ $content->video_url }}" target="_blank">{{ $content->video_url }}</a></p>
                                                    <p><strong>Length:</strong> {{ $content->video_length ?? 'N/A' }}</p>
                                                    @break
                                            @endswitch
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted">No content available for this module.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-danger fs-6 mt-3">
                    {{ __('No modules found for this course.') }}
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="d-flex justify-content-start align-items-center">
            <a href="{{ route('course.index') }}">
                <x-show-back-button />
            </a>
        </div>
    </div>
</div>
@endsection