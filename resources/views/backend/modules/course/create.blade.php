@extends('backend.layouts.app')
@section('content')
    {{ html()->form('POST', route('course.store'))->acceptsFiles()->open() }}
    @include('backend.modules.course.partials._form')
    <x-create-button />
    {{ html()->form()->close() }}
@endsection
