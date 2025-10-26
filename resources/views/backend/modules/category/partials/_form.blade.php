@php
    use App\Models\Category;
@endphp

<div class="mt-4 row justify-content-center">
    <div class="col-lg-5">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Name'), 'name')->class('form-label') }}
            <x-required />
            {{ html()->text('name')->id('name')->class('form-control ' . ($errors->has('name') ? ' is-invalid' : null))->placeholder(__('Enter name')) }}
            @error('name')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="col-lg-5">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Status'), 'status')->class('form-label') }}
            {{ html()->select('status', Category::STATUS_LIST, isset($category) ? $category->status : Category::STATUS_ACTIVE)->id('status')->class('form-select ' . ($errors->has('status') ? ' is-invalid' : null))->placeholder(__('Select status')) }}
            @error('status')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
</div>
