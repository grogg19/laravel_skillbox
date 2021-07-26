<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
{{--    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">--}}

    <title>@yield('title', 'Laravel Skillbox')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
</head>

<body>

<div class="container">

    @include('partials/header')

    @include('partials/nav')

</div>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">

            @yield('content')

        </div><!-- /.blog-main -->

        @include('partials/sidebar')

    </div><!-- /.row -->

</main><!-- /.container -->

@include('partials/footer')

</body>
</html>
