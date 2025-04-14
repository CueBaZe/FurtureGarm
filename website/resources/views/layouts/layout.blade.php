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
        <div class="container">
            <div class="row text-center">
                <div class="col-4">
                    <a href="#" class="link" data-bs-toggle="tooltip" title="Settings"><i class='bx bx-cog'></i></a>
                </div>
                <div class="col-4">
                    <a href="#" class="link" data-bs-toggle="tooltip" title="Home"><i class='bx bx-home'></i></a>
                </div>
                <div class="col-4">
                    <a href="#" class="link" data-toggle="modal" data-target="#createTimeCapsule"><i class='bx bxs-hourglass'></i></a>
                </div>
            </div>
        </div>
    </div>


    <div id="createTimeCapsule" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header rounded-top">
                    <h5 class="modal-title mx-auto">
                        <i class="bx bx-time"></i> Create TimeCapsule
                    </h5>
                </div>
    
                <div class="modal-body text-center">
                    <p class="lead">Because some messages are meant for later. ⌛</p>
                    <!-- You can replace this with your form later -->
                    <form action="{{ route('timecapsuleCreate') }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row justify-content-center">
                                <input type="text" class="col-6 mt-4" name="title" placeholder="Title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                                <textarea name="text" class="col-8 mt-4" rows="5" maxlength="300" name="text" id="timecapsuleText" placeholder="Insert your text here.. (Maximum 300 characters)">{{ old('text') }}</textarea>
                                @error('text')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                                <input type="date" class="col-6 mt-4" id="datePicker" name="time" value="{{ old('time') }}" onkeydown="return false">
                                @error('time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>
                </div>
    
                <div class="modal-footer justify-content-between px-4">
                    <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="create">Create TimeCapsule</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@if ($errors->any())
<script>
    window.showCreateModal = true;
</script>
@else
<script>
    window.showCreateModal = false;
</script>
@endif

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/datePicker.js') }}"></script>
</html>