<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Z Blog is Blog :)" />
  <meta name="author" content="Ali Azhar" />
  <title>Z-Blog | {{ $title }}</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="/img/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="/css/styles.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
  <!-- Responsive navbar-->
  @include('blog.partials.navbar')

  @yield('header')

  <!-- Page content-->
  <div class="container">
    @yield('content')
  </div>

  <!-- Footer-->
  @yield('footer')

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Core theme JS-->
  <script src="/js/scripts.js"></script>
</body>

</html>
