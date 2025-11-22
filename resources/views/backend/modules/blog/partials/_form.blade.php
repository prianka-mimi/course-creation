@php
use App\Models\Blog;
@endphp

<div class="mt-4 row">
    <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Name'), 'name')->class('form-label') }}
            <x-required />
            {{ html()->text('name')->id('name')->class('form-control ' . ($errors->has('name') ? ' is-invalid' : null))->placeholder(__('Enter name')) }}
            @error('name')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Status'), 'status')->class('form-label') }}
            {{ html()->select('status', Blog::STATUS_LIST, isset($blog) ? $blog->status : Blog::STATUS_ACTIVE)->id('status')->class('form-select ' . ($errors->has('status') ? ' is-invalid' : null))->placeholder(__('Select status')) }}
            @error('status')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3 form-group">
            {{ html()->label(__('Description'))->for('description') }}
            <x-required />
            {{ html()->text('description')->id('description')->class('form-control tinymce ' . ($errors->has('description') ? ' is-invalid' : null))->placeholder(__('e.g., Description')) }}
            @error('description')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="row justify-description-center align-items-center justify-content-center">
        <div class="col-lg-4">
            <div class="mb-4 custom-input-group">
                {{ html()->label(__('Image'), 'image')->class('form-label') }}
                {{ html()->file('image')->id('image')->class('form-control ' . ($errors->has('image') ? ' is-invalid' : null)) }}
                @error('image')
                    <x-validation-error :message="$message" />
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="image-preview-area">
                <img src="{{ isset($blog) ? get_image(Blog::IMAGE_PATH . $blog->image) : null }}" alt="" id="preview"
                    class="img-fluid" />
            </div>
        </div>
    </div>
</div>
