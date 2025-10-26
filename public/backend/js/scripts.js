window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});

function slug($string) {
    return $string
        .toString()
        .trim()
        .toLowerCase()
        .replace(/[\s_]+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+|-+$/g, '');
}

$('#name, #title').on('input', function () {
    $('#slug').val(slug($(this).val()));
});

$('#image, #photo, #logo').on('change', function () {
    let reader = new FileReader();
    reader.onload = function () {
        let output = $('#preview');
        output.attr('src', reader.result);
    };
    reader.readAsDataURL(this.files[0]);
});

$(document).ready(function() {
    $('.live-search').select2({
        // placeholder: 'Select Multiple',
    });
});

$(document).ready(function() {
    const activeNavKey = 'activeNavLinkHref';
    const successColorClass = 'text-success';

    function applyActiveStyleAndExpandParents($targetLink) {
        if (!$targetLink || $targetLink.length === 0) {
            return;
        }

        $('.nav-link').removeClass('active').removeClass(successColorClass);

        $targetLink.addClass('active').addClass(successColorClass);

        $targetLink.parents('.collapse').each(function() {
            const $collapseDiv = $(this);
            if (!$collapseDiv.hasClass('show')) {
                $collapseDiv.addClass('show');
            }

            const collapseId = $collapseDiv.attr('id');
            if (collapseId) {
                const $togglerLink = $(`a.nav-link[data-bs-toggle="collapse"][data-bs-target="#${collapseId}"]`);
                if ($togglerLink.length > 0) {
                    $togglerLink.addClass('active').addClass(successColorClass);
                    if ($collapseDiv.hasClass('show')) {
                        $togglerLink.removeClass('collapsed');
                    }
                }
            }
        });

        if ($targetLink.attr('data-bs-toggle') === 'collapse') {
            const targetCollapseId = $targetLink.attr('data-bs-target');
            if (targetCollapseId) {
                if ($(targetCollapseId).hasClass('show')) {
                    $targetLink.removeClass('collapsed');
                }
            }
        }
    }

    const storedActiveHref = localStorage.getItem(activeNavKey);
    if (storedActiveHref && storedActiveHref !== "#") {
        const $activeLinkOnLoad = $('.nav-link[href="' + storedActiveHref + '"]');
        if ($activeLinkOnLoad.length > 0) {
            applyActiveStyleAndExpandParents($activeLinkOnLoad);
        }
    }

    $('.nav-link').on('click', function() {
        const $clickedLink = $(this);
        const clickedHref = $clickedLink.attr('href');

        if (clickedHref && clickedHref !== "#") {
            localStorage.setItem(activeNavKey, clickedHref);
        }
        applyActiveStyleAndExpandParents($clickedLink);
    });

    $('.nav-link').hover(
        function() {
            $(this).addClass(successColorClass);
        },
        function() {
            if (!$(this).hasClass('active')) {
                $(this).removeClass(successColorClass);
            }
        }
    );
});
