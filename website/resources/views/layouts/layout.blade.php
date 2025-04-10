<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="header">
        <h3 class="logotext"><i class='bx bx-time logo'></i> FutureGram</h3>
    </div>

    <main>
        @yield('page-content')
    </main>

    <div class="footer container-fluid">
    <div class="row text-center">
        <div class="col-4">
            <a href="#" class="link" data-bs-toggle="tooltip" title="Settings"><i class='bx bx-cog'></i></a>
        </div>
        <div class="col-4">
            <a href="#" class="link" data-bs-toggle="tooltip" title="Home"><i class='bx bx-home'></i></a>
        </div>
        <div class="col-4">
            <a href="#" class="link" data-bs-toggle="tooltip" title="Create timecapsule"><i class='bx bxs-hourglass'></i></a>
        </div>
    </div>
</div>

</body>
</html>