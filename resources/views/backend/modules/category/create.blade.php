@extends('backend.layouts.app')
@section('content')
    {{ html()->form('POST', route('category.store'))->acceptsFiles()->open() }}
    @include('backend.modules.category.partials._form')
    <x-create-button />
    {{ html()->form()->close() }}
@endsection
