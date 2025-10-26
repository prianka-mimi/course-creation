@extends('backend.layouts.app')
@section('content')
    {{ html()->modelForm($course, 'PUT', route('course.update', $course->id))->acceptsFiles()->open() }}
    @include('backend.modules.course.partials._form')
    <x-update-button />
    {{ html()->form()->close() }}
@endsection
