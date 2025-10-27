@extends('backend.layouts.app')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <strong>Validation Errors:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{ html()->modelForm($course, 'PUT', route('course.update', $course->id))->acceptsFiles()->open() }}
    @include('backend.modules.course.partials._form')
    <x-update-button />
    {{ html()->form()->close() }}
@endsection
