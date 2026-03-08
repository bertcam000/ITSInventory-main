<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/img/its_logo.png">
  @vite('resources/css/app.css')
</head>

@if (session('success'))
    <x-notification :message="session('success')" type="success" />
@endif
    <body class="bg-slate-50 text-slate-900">
        {{ $slot }}
    </body>
</html>