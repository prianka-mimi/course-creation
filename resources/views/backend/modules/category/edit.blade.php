@extends('backend.layouts.app')
@section('content')
    {{ html()->modelForm($category, 'PUT', route('category.update', $category->id))->acceptsFiles()->open() }}
    @include('backend.modules.category.partials._form')
    <x-update-button />
    {{ html()->form()->close() }}
@endsection
