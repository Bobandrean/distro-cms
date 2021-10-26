<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>GrosirOne Distro</title>

    <link href="{{ asset('/css/modern.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <style>
        body {
            font-size: 12px !important;
        }
        .select2-container .select2-selection--single{
            font-size: 12px !important;
        }
    </style>

    <script src="{{ asset('/js/settings.js') }}"></script>

    <script src="{{ asset('/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    <script src="{{ asset('/js/currency.js') }}"></script>
    <script src="{{ asset('/js/currency-script.js') }}"></script>
</head>

<body>
{{--<div class="splash active">--}}
{{--    <div class="splash-icon"></div>--}}
{{--</div>--}}
@include('components.notification')

<div class="wrapper">
    @include('components.side-navbar')

    <div class="main">

        @include('components.top-navbar')

        <main>
            @yield('content')
        </main>

        @include('components.foobar')
    </div>
</div>

{{--<svg width="0" height="0" style="position:absolute">--}}
{{--    <defs>--}}
{{--        <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">--}}
{{--            <path--}}
{{--                d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">--}}
{{--            </path>--}}
{{--        </symbol>--}}
{{--    </defs>--}}
{{--</svg>--}}

<script>
    $(document).ready(function () {
        $('select').select2({
            width: '100%'
        });

        ClassicEditor
            .create(document.querySelector('textarea'))
            .then(editor => {
            })
            .catch(error => {
            });

        // $('#myTab a').click(function (e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });
        //
        // // store the currently selected tab in the hash value
        // $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        //     var id = $(e.target).attr("href").substr(1);
        //     window.location.hash = id;
        // });
        //
        // // on load of the page: switch to the currently selected tab
        // var hash = window.location.hash;
        // $('#myTab a[href="' + hash + '"]').tab('show');
    });
</script>

@yield('script')
</body>

</html>
