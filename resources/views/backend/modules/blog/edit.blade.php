@extends('backend.layouts.app')
@section('content')
    {{ html()->modelForm($blog, 'PUT', route('blog.update', $blog->id))->acceptsFiles()->open() }}
    @include('backend.modules.blog.partials._form')
    <x-update-button />
    {{ html()->form()->close() }}
@endsection
