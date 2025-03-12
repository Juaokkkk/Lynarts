<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="\assets/css/navbar.css">
    <link rel="stylesheet" href="\assets/css/home.css">
    <link rel="stylesheet" href="\assets/css/forms.css">
    <link rel="stylesheet" href="\assets/css/suport.css">
    <link rel="stylesheet" href="\assets/css/catalog.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title> @yield('title') </title>
</head>

<body>
    <header>
        @include('layouts.navbar')
    </header>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://kit.fontawesome.com/e4fc4787e3.js" crossorigin="anonymous"></script>
</body>

</html>
