<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <base href="{{ asset('assets') . '/' }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="images/favicon.png" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="css/lib/bootstrap.min.css">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="css/lib/apexcharts.css">
    <!-- Data Table css -->
    <link rel="stylesheet" href="css/lib/dataTables.min.css">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="css/lib/editor-katex.min.css">
    <link rel="stylesheet" href="css/lib/editor.atom-one-dark.min.css">
    <link rel="stylesheet" href="css/lib/editor.quill.snow.css">
    <!-- Date picker css -->
    <link rel="stylesheet" href="css/lib/flatpickr.min.css">
    <!-- Calendar css -->
    <link rel="stylesheet" href="css/lib/full-calendar.css">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="css/lib/jquery-jvectormap-2.0.5.css">
    <!-- Popup css -->
    <link rel="stylesheet" href="css/lib/magnific-popup.css">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="css/lib/slick.css">
    <!-- prism css -->
    <link rel="stylesheet" href="css/lib/prism.css">
    <!-- file upload css -->
    <link rel="stylesheet" href="css/lib/file-upload.css">

    <link rel="stylesheet" href="css/lib/audioplayer.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">


    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    @notifyCss

    <style type="text/css">
        .notify {
            z-index: 1001 !important;
        }
    </style>
</head>

<body>
    @include('dashboard.partials.sidebar')

    <main class="dashboard-main">

        @include('dashboard.partials.header')

        <div class="dashboard-main-body">
@include('message')
            @yield('content')

        </div>

        @include('dashboard.partials.footer')

    </main>

    @include('notify::components.notify')

    <!-- jQuery library js -->
    <script src="js/lib/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/lib/bootstrap.bundle.min.js"></script>
    <!-- Apex Chart js -->
    <script src="js/lib/apexcharts.min.js"></script>
    <!-- Data Table js -->
    <script src="js/lib/dataTables.min.js"></script>
    <!-- Iconify Font js -->
    <script src="js/lib/iconify-icon.min.js"></script>
    <!-- jQuery UI js -->
    <script src="js/lib/jquery-ui.min.js"></script>
    <!-- Vector Map js -->
    <script src="js/lib/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="js/lib/jquery-jvectormap-world-mill-en.js"></script>
    <!-- Popup js -->
    <script src="js/lib/magnifc-popup.min.js"></script>
    <!-- Slick Slider js -->
    <script src="js/lib/slick.min.js"></script>
    <!-- prism js -->
    <script src="js/lib/prism.js"></script>
    <!-- file upload js -->
    <script src="js/lib/file-upload.js"></script>
    <!-- audioplayer -->
    <script src="js/lib/audioplayer.js"></script>

    <!-- main js -->
    <script src="js/app.js"></script>

    <script src="js/homeThreeChart.js"></script>

    <script>
        function logout() {
            $.ajax({
                url: "{{ route('logout') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect ;
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        };
    </script>

    @notifyJs

</body>

</html>
