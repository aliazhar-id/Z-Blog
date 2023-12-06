<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Z Blog is Blog :)" />
  <meta name="author" content="Ali Azhar" />
  <title>Z-Blog | {{ $title }}</title>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="/css/styles.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Favicon-->
  <link rel="apple-touch-icon" sizes="57x57" href="/assets/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/assets/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/assets/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/assets/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/assets/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/assets/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/assets/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
  <link rel="manifest" href="/assets/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/assets/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Responsive navbar-->
  @include('blog.partials.navbar')

  @yield('header')

  <!-- Page content-->
  <div class="container">
    @yield('content')
  </div>

  <!-- Footer-->
  @include('blog.partials.footer')

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Core theme JS-->
  <script src="/js/scripts.js"></script>

  @yield('custom-script')
</body>

</html>
