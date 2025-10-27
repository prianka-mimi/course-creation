<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.tiny.cloud/1/arxrhhtgb4lfhvgugxixqldhw2e9h70rtqvveogdsm06zieg/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.2.50/es2021/jodit.fat.min.js"
    integrity="sha512-0MCdQHL1SpUBATxw2DY/gm3y54QC1VIYMCnB7IHQ3La1htIkid4yZYsW15QU9+IOuWfEjEVyirL4KBTkHjZP7w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('backend/js/scripts.js') }}"></script>
<script>
    if ('{{ session()->has('message') }}') {
        Swal.fire({
            position: "top-end",
            icon: "{{ session()->get('class') }}",
            toast: true,
            title: "{{ session()->get('message') }}",
            showConfirmButton: false,
            timer: 3000
        });
    }

    tinymce.init({
        selector: '.tinymce',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<script>
    const resetFilters = () => {
        let url = new URL(window.location.href)
        url.search = '';
        window.location.href = url.toString()
    }

    $('#reset_fields').on('click', function() {
        resetFilters()
    })


    $('#per_page_input').on('change', function() {
        let per_page = $(this).val()
        $('input[name="per_page"]').val(per_page)
        $('#search_form').submit()
    })


    const handlePerPageOnLoad = () => {
        let urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('per_page')) {
            let perPageValue = urlParams.get('per_page');
            $('#per_page_input').val(perPageValue)
        }
    }
    handlePerPageOnLoad()
</script>

<script>
    $('.delete-btn').on('click', function(e) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    })
</script>

<script>
    $(document).ready(function() {
        $('select[multiple].live-search').each(function() {
            const $this = $(this);
            let placeholder = $this.data('placeholder') || $this.attr('placeholder') ||
                'Select options';

            $this.find('option[disabled][value=""]').remove();
            $this.find('option[value=""]').remove();

            $this.select2({
                placeholder: placeholder,
                allowClear: false,
                multiple: true,
                closeOnSelect: true,
                width: '100%',
                escapeMarkup: function(markup) {
                    return markup;
                },
                language: {
                    noResults: function() {
                        return "No results found";
                    },
                    searching: function() {
                        return "Searching...";
                    }
                }
            });
        });

        $('select:not([multiple]).live-search').each(function() {
            const $this = $(this);
            let placeholder = $this.data('placeholder') || $this.attr('placeholder') || 'Select option';

            $this.select2({
                placeholder: placeholder,
                allowClear: false,
                width: '100%'
            });
        });
    });
</script>

<script>
$(document).ready(function() {
    let moduleIndex = $('#modules-container .module-section').length;

    $('#add-module').on('click', function() {
        addModule();
    });

    function addModule(existingModule = null, moduleIdx = null) {
        if (moduleIdx === null) {
            moduleIdx = moduleIndex++;
        }
        let moduleHtml = $('#module-template').html()
            .replace(/__MODULE_INDEX__/g, moduleIdx)
            .replace(/__MODULE_NUMBER__/g, moduleIdx + 1);

        $('#modules-container').append(moduleHtml);
    }

    function generateContentHtml(moduleIdx, contentIdx, existingContent = null) {
        let contentHtml = $('#content-template').html()
            .replace(/__MODULE_INDEX__/g, moduleIdx)
            .replace(/__CONTENT_INDEX__/g, contentIdx)
            .replace(/__CONTENT_NUMBER__/g, contentIdx + 1);

        if (existingContent) {
            contentHtml = contentHtml.replace(/value=""/g, (match) => {
                if (match.includes('title')) return `value="${existingContent.title || ''}"`;
                if (match.includes('type')) return `value="${existingContent.type || ''}"`;
                return match;
            });
        }

        return contentHtml;
    }

    $(document).on('click', '.add-content', function() {
        let moduleSection = $(this).closest('.module-section');
        let moduleIdx = moduleSection.data('module-index');
        let contentIdx = moduleSection.find('.content-section').length;
        let contentHtml = generateContentHtml(moduleIdx, contentIdx);
        moduleSection.find('.contents-container').append(contentHtml);
    });

    $(document).on('change', '.content-type-select', function() {
        let contentSection = $(this).closest('.content-section');
        let contentIdx = contentSection.data('content-index');
        let moduleIdx = contentSection.closest('.module-section').data('module-index');
        let selectedType = $(this).val();
        let fieldsContainer = contentSection.find('.content-fields');

        fieldsContainer.empty();

        let fieldsHtml = '';
        if (selectedType === 'text') {
            fieldsHtml = `
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][content_text]" class="form-label">Content Text</label>
                            <textarea name="modules[${moduleIdx}][contents][${contentIdx}][content_text]" class="form-control" placeholder="Enter content text" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            `;
        } else if (selectedType === 'image') {
            fieldsHtml = `
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][image_path]" class="form-label">Image</label>
                            <input type="file" name="modules[${moduleIdx}][contents][${contentIdx}][image_path]" class="form-control" accept="image/*">
                            <small class="text-muted">Supported formats: JPEG, JPG, PNG, GIF (Max: 5MB)</small>
                        </div>
                    </div>
                </div>
            `;
        } else if (selectedType === 'video') {
            fieldsHtml = `
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][video_source_type]" class="form-label">Video Source Type</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_source_type]" class="form-control" placeholder="e.g., YouTube, Vimeo">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][video_url]" class="form-label">Video URL</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_url]" class="form-control" placeholder="Enter video URL">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][video_length]" class="form-label">Video Length (HH:MM:SS)</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_length]" class="form-control" placeholder="00:00:00">
                        </div>
                    </div>
                </div>
            `;
        } else if (selectedType === 'link') {
            fieldsHtml = `
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][link_url]" class="form-label">Link URL</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][link_url]" class="form-control" placeholder="Enter link URL">
                        </div>
                    </div>
                </div>
            `;
        }

        fieldsContainer.html(fieldsHtml);
    });

    $(document).on('click', '.remove-module', function() {
        $(this).closest('.module-section').remove();
        updateModuleIndices();
    });

    $(document).on('click', '.remove-content', function() {
        $(this).closest('.content-section').remove();
        updateContentIndices();
    });

    function updateModuleIndices() {
        $('#modules-container .module-section').each(function(index) {
            $(this).attr('data-module-index', index);
            $(this).find('h6').text(`Module ${index + 1}`);
            $(this).find('input[name*="modules["]').each(function() {
                let name = $(this).attr('name');
                $(this).attr('name', name.replace(/modules\[\d+\]/, `modules[${index}]`));
            });
            $(this).find('select[name*="modules["]').each(function() {
                let name = $(this).attr('name');
                $(this).attr('name', name.replace(/modules\[\d+\]/, `modules[${index}]`));
            });
            $(this).find('.content-section').each(function(contentIndex) {
                updateContentIndex($(this), index, contentIndex);
            });
        });
        moduleIndex = $('#modules-container .module-section').length;
    }

    function updateContentIndices() {
        $('.module-section').each(function(moduleIdx) {
            $(this).find('.content-section').each(function(contentIdx) {
                updateContentIndex($(this), moduleIdx, contentIdx);
            });
        });
    }

    function updateContentIndex(contentSection, moduleIdx, contentIdx) {
        contentSection.attr('data-content-index', contentIdx);
        contentSection.find('h6').text(`Content ${contentIdx + 1}`);
        contentSection.find('input[name*="contents["]').each(function() {
            let name = $(this).attr('name');
            $(this).attr('name', name.replace(/modules\[\d+\]\[contents\]\[\d+\]/, `modules[${moduleIdx}][contents][${contentIdx}]`));
        });
        contentSection.find('select[name*="contents["]').each(function() {
            let name = $(this).attr('name');
            $(this).attr('name', name.replace(/modules\[\d+\]\[contents\]\[\d+\]/, `modules[${moduleIdx}][contents][${contentIdx}]`));
        });
        contentSection.find('textarea[name*="contents["]').each(function() {
            let name = $(this).attr('name');
            $(this).attr('name', name.replace(/modules\[\d+\]\[contents\]\[\d+\]/, `modules[${moduleIdx}][contents][${contentIdx}]`));
        });
    }
});
</script>
@stack('scripts')
