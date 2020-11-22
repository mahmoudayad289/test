<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Open Graph Meta-->
    <title>Project Name | @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/main.css') }}">
    <!-- noty css file -->

    <!-- jquery file  -->
    <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <!-- noty js file  -->
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}" type="text/javascript"></script>
</head>

<body class="app sidebar-mini">

<!-- Navbar-->
@include('dashboard.includes._navbar')
<!-- Sidebar menu-->
@include('dashboard.includes._sidebar')


<main class="app-content">
    @include('dashboard.includes._session')
    @yield('content')
</main>

{{-- include footer --}}
<!-- Essential javascripts for application to work-->

<script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/js/main.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var that = $(this);
            var n = new Noty({
                layout: 'topRight',
                theme: 'light',
                text: "@lang('site.you_sure_delete')",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-primary m-2', function () {
                        that.closest('form').submit();
                    }),
                    Noty.button("@lang('site.no')", 'btn btn-danger', function () {
                        n.close()
                    }),
                ]
            });
            n.show();
        });


        $("#select-all").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });


        $('.image').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-perview').attr('src', e.target.result);
                };

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });


    });
</script>
</body>
</html>

