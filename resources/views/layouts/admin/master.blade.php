<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/fontawesome/css/all.css') }}">
    @yield('styles')
</head>

<body>
    @include('layouts.admin.navbar')

    <div class="container py-4">
        @yield('content')
    </div>


    <script src="{{ asset('admin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/fontawesome/js/all.js') }}"></script>
    @yield('scripts')
</body>

</html>
