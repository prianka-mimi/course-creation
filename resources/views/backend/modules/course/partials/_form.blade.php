@php
    use App\Models\Course;
@endphp

<div class="mt-4 row">
    <div class="col-lg-6">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Title'), 'title')->class('form-label') }}
            <x-required />
            {{ html()->text('title')->id('title')->class('form-control ' . ($errors->has('title') ? ' is-invalid' : null))->placeholder(__('Enter title')) }}
            @error('title')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Description'), 'description')->class('form-label') }}
            {{ html()->textarea('description')->id('description')->class('form-control ' . ($errors->has('description') ? ' is-invalid' : null))->placeholder(__('Enter course description'))->rows(3) }}
            @error('description')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Category'), 'category')->class('form-label') }}
            <x-required />
            {{ html()->select('category', $category, isset($course) ? $course->category : null)->id('category')->class('form-select live-search' . ($errors->has('category') ? ' is-invalid' : null))->multiple()->placeholder(__('Select category')) }}
            @error('category')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-4 custom-input-group">
            {{ html()->label(__('Featured Video'), 'feature_video')->class('form-label') }}
            {{ html()->file('feature_video')->id('feature_video')->class('form-control ' . ($errors->has('feature_video') ? ' is-invalid' : null))->accept('video/*') }}
            <small class="text-muted">Supported formats: MP4, MOV, AVI, WMV (Max: 100MB)</small>
            @error('feature_video')
                <x-validation-error :message="$message" />
            @enderror
        </div>
    </div>
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

<div class="mt-4">
    <h5 class="text-center pb-2">{{ __('Modules Section') }}</h5>
    <div id="modules-container">
        @if(isset($course) && $course->modules)
            @foreach($course->modules as $index => $module)
                <div class="module-section border p-3 mb-3" data-module-index="{{ $index }}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6>{{ __('Module') }} {{ $index + 1 }}</h6>
                        <button type="button" class="btn btn-danger btn-sm remove-module">Remove Module</button>
                    </div>
                    <div class="row text-center">
                        <div class="col-lg-6">
                            <div class="mb-4 custom-input-group">
                                {{ html()->label(__('Module Title'), 'modules[' . $index . '][title]')->class('form-label') }}
                                <x-required />
                                {{ html()->text('modules[' . $index . '][title]')->class('form-control')->value($module->title)->placeholder(__('Enter module title')) }}
                            </div>
                        </div>
                    </div>
                    <div class="contents-container">
                        @if($module->contents)
                            @foreach($module->contents as $contentIndex => $content)
                                <div class="content-section border p-2 mb-2" data-content-index="{{ $contentIndex }}">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>{{ __('Content') }} {{ $contentIndex + 1 }}</h6>
                                        <button type="button" class="btn btn-danger btn-sm remove-content">Remove Content</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2 custom-input-group">
                                                {{ html()->label(__('Content Title'), 'modules[' . $index . '][contents][' . $contentIndex . '][title]')->class('form-label') }}
                                                <x-required />
                                                {{ html()->text('modules[' . $index . '][contents][' . $contentIndex . '][title]')->class('form-control')->value($content->title)->placeholder(__('Enter content title')) }}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2 custom-input-group">
                                                {{ html()->label(__('Content Type'), 'modules[' . $index . '][contents][' . $contentIndex . '][type]')->class('form-label') }}
                                                <x-required />
                                                {{ html()->select('modules[' . $index . '][contents][' . $contentIndex . '][type]', ['text' => 'Text', 'image' => 'Image', 'video' => 'Video', 'link' => 'Link'], $content->type)->class('form-select content-type-select')->data('content-index', $contentIndex) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-fields" data-content-index="{{ $contentIndex }}">
                                        @if($content->type == 'text')
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-2 custom-input-group">
                                                        {{ html()->label(__('Content Text'), 'modules[' . $index . '][contents][' . $contentIndex . '][content_text]')->class('form-label') }}
                                                        {{ html()->textarea('modules[' . $index . '][contents][' . $contentIndex . '][content_text]')->class('form-control')->value($content->content_text)->placeholder(__('Enter content text'))->rows(3) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($content->type == 'image')
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-2 custom-input-group">
                                                        {{ html()->label(__('Image'), 'modules[' . $index . '][contents][' . $contentIndex . '][image_path]')->class('form-label') }}
                                                        {{ html()->file('modules[' . $index . '][contents][' . $contentIndex . '][image_path]')->class('form-control')->accept('image/*') }}
                                                        <small class="text-muted">Supported formats: JPEG, JPG, PNG, GIF (Max: 5MB)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($content->type == 'video')
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-2 custom-input-group">
                                                        {{ html()->label(__('Video Source Type'), 'modules[' . $index . '][contents][' . $contentIndex . '][video_source_type]')->class('form-label') }}
                                                        {{ html()->text('modules[' . $index . '][contents][' . $contentIndex . '][video_source_type]')->class('form-control')->value($content->video_source_type)->placeholder(__('e.g., YouTube, Vimeo')) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-2 custom-input-group">
                                                        {{ html()->label(__('Video URL'), 'modules[' . $index . '][contents][' . $contentIndex . '][video_url]')->class('form-label') }}
                                                        {{ html()->text('modules[' . $index . '][contents][' . $contentIndex . '][video_url]')->class('form-control')->value($content->video_url)->placeholder(__('Enter video URL')) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-2 custom-input-group">
                                                        {{ html()->label(__('Video Length (HH:MM:SS)'), 'modules[' . $index . '][contents][' . $contentIndex . '][video_length]')->class('form-label') }}
                                                        {{ html()->text('modules[' . $index . '][contents][' . $contentIndex . '][video_length]')->class('form-control')->value($content->video_length)->placeholder(__('00:00:00')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($content->type == 'link')
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-2 custom-input-group">
                                                        {{ html()->label(__('Link URL'), 'modules[' . $index . '][contents][' . $contentIndex . '][link_url]')->class('form-label') }}
                                                        {{ html()->text('modules[' . $index . '][contents][' . $contentIndex . '][link_url]')->class('form-control')->value($content->link_url)->placeholder(__('Enter link URL')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-4">
                            <div class="d-grid">
                                <button type="button" class="btn theme-button create-button btn-sm add-content"><i class="fa-solid fa-plus"></i> Add Content</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <!-- Template for new content -->
    <div id="content-template" style="display: none;">
        <div class="content-section border p-2 mb-2" data-content-index="__CONTENT_INDEX__">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6>{{ __('Content') }} __CONTENT_NUMBER__</h6>
                <button type="button" class="btn btn-danger btn-sm remove-content">Remove Content</button>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-2 custom-input-group">
                        {{ html()->label(__('Content Title'), 'modules[__MODULE_INDEX__][contents][__CONTENT_INDEX__][title]')->class('form-label') }}
                        <x-required />
                        {{ html()->text('modules[__MODULE_INDEX__][contents][__CONTENT_INDEX__][title]')->class('form-control')->placeholder(__('Enter content title')) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-2 custom-input-group">
                        {{ html()->label(__('Content Type'), 'modules[__MODULE_INDEX__][contents][__CONTENT_INDEX__][type]')->class('form-label') }}
                        <x-required />
                        {{ html()->select('modules[__MODULE_INDEX__][contents][__CONTENT_INDEX__][type]', ['text' => 'Text', 'image' => 'Image', 'video' => 'Video', 'link' => 'Link'], null)->class('form-select content-type-select')->data('content-index', '__CONTENT_INDEX__') }}
                    </div>
                </div>
            </div>
            <div class="content-fields" data-content-index="__CONTENT_INDEX__">
                <!-- Dynamic fields will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Template for module -->
    <div id="module-template" style="display: none;">
        <div class="module-section border p-3 mb-3" data-module-index="__MODULE_INDEX__">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>{{ __('Module') }} __MODULE_NUMBER__</h6>
                <button type="button" class="btn btn-danger btn-sm remove-module">Remove Module</button>
            </div>
            <div class="row text-center">
                <div class="col-lg-6">
                    <div class="mb-4 custom-input-group">
                        {{ html()->label(__('Module Title'), 'modules[__MODULE_INDEX__][title]')->class('form-label') }}
                        <x-required />
                        {{ html()->text('modules[__MODULE_INDEX__][title]')->class('form-control')->placeholder(__('Enter module title')) }}
                    </div>
                </div>
            </div>
            <div class="contents-container">
                <!-- Contents will be added here -->
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-4">
                    <div class="d-grid">
                        <button type="button" class="btn theme-button create-button btn-sm add-content" data-module-index="__MODULE_INDEX__"><i class="fa-solid fa-plus"></i> Add Content</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
            <div class="d-grid">
                <button type="button" class="btn theme-button create-button" id="add-module"><i class="fa-solid fa-plus"></i> Add Module</button>
            </div>
        </div>
    </div>
</div>
