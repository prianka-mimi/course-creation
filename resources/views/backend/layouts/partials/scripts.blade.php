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
@stack('scripts')
