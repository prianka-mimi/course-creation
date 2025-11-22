@extends('backend.layouts.app')
@section('content')
    {{ html()->form('POST', route('blog.store'))->acceptsFiles()->open() }}
    @include('backend.modules.blog.partials._form')
    <x-create-button />
    {{ html()->form()->close() }}
@endsection
