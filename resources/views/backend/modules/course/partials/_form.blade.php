@php
    use App\Models\Course;
@endphp

<div class="mt-4 row">
    <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Title'), 'title')->class('form-label') }}
            <x-required />
            {{ html()->text('title')->id('title')->class('form-control ' . ($errors->has('title') ? ' is-invalid' : null))->placeholder(__('Enter title')) }}
            @error('title')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    {{-- <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Category'), 'category')->class('form-label') }}
            <x-required />
            {{ html()->select('category', $getCategoryAssociates)->id('category')->class('form-select ' . ($errors->has('category') ? ' is-invalid' : null))->placeholder(__('Select category')) }}
            @error('category')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Status'), 'status')->class('form-label') }}
            {{ html()->select('status', Course::STATUS_LIST, isset($course) ? $course->status : Course::STATUS_ACTIVE)->id('status')->class('form-select ' . ($errors->has('status') ? ' is-invalid' : null))->placeholder(__('Select status')) }}
            @error('status')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
</div>
