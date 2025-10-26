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
        let moduleHtml = `
            <div class="module-section border p-3 mb-3" data-module-index="${moduleIdx}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>Module ${moduleIdx + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-module">Remove Module</button>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4 custom-input-group">
                            <label for="modules[${moduleIdx}][title]" class="form-label">Module Title</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="modules[${moduleIdx}][title]" class="form-control" placeholder="Enter module title" value="${existingModule ? existingModule.title : ''}" required>
                        </div>
                    </div>
                </div>
                <div class="contents-container">
                    ${existingModule && existingModule.contents ? existingModule.contents.map((content, contentIdx) => generateContentHtml(moduleIdx, contentIdx, content)).join('') : ''}
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-lg-4">
                        <div class="d-grid">
                            <button type="button" class="btn theme-button create-button btn-sm add-content"><i class="fa-solid fa-plus"></i> Add Content</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#modules-container').append(moduleHtml);
    }

    function generateContentHtml(moduleIdx, contentIdx, existingContent = null) {
        return `
            <div class="content-section border p-2 mb-2" data-content-index="${contentIdx}">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6>Content ${contentIdx + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-content">Remove Content</button>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][title]" class="form-label">Content Title</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][title]" class="form-control" placeholder="Enter content title" value="${existingContent ? existingContent.title : ''}" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][video_source_type]" class="form-label">Video Source Type</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_source_type]" class="form-control" placeholder="e.g., YouTube, Vimeo" value="${existingContent ? existingContent.video_source_type : ''}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][video_url]" class="form-label">Video URL</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_url]" class="form-control" placeholder="Enter video URL" value="${existingContent ? existingContent.video_url : ''}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2 custom-input-group">
                            <label for="modules[${moduleIdx}][contents][${contentIdx}][video_length]" class="form-label">Video Length (HH:MM:SS)</label>
                            <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][video_length]" class="form-control" placeholder="00:00:00" value="${existingContent ? existingContent.video_length : ''}">
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    $(document).on('click', '.add-content', function() {
        let moduleSection = $(this).closest('.module-section');
        let moduleIdx = moduleSection.data('module-index');
        let contentIdx = moduleSection.find('.content-section').length;
        let contentHtml = generateContentHtml(moduleIdx, contentIdx);
        moduleSection.find('.contents-container').append(contentHtml);
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
    }
});
</script>
@stack('scripts')
