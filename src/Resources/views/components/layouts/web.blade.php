<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" user-scalable="no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Lightworx - {{$pageName}}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- Favicons -->
  <link href="{{ asset('lightworx/images/icons/favicon.png') }}" rel="icon">
  <link href="{{ asset('lightworx/images/icons/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Media player -->  
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/{{setting('site_theme')}}/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <main class="main">
    {{$slot}}
  </main>

  <footer class="fixed-bottom bg-dark text-center text-white p-3">&copy;{{date('Y')}} Lightworx</footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('lightworx/js/bootstrap-bundle.min.js') }}"></script>
  <script src="{{ asset('lightworx/js/custom.js') }}"></script>
</body>

</html>
