<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card text-center col-10 col-sm-10 col-md-8 col-lg-6">
                <div class="brand">
                    <i class='bx bx-time' id="logo"></i>
                    <h3 class="title">FutureGram</h3>
                    <p class="motto">Because some messages are meant for later.</p>
                </div>
                <form action="{{ route('loginpost') }}" method="POST">
                    @csrf
                    <div class="inputs">
                        <div class="emailbox">
                            <i class='bx bx-user' ></i>
                            <input type="text" class="email col-8" name="email" placeholder="Email">
                            <br>
                            @if($errors->has('email')) 
                                <span class="error col-12"><i class='bx bx-error-circle errorCircle'></i> {{$errors->first('email')}}</span>
                            @endif
                        </div>

                        <div class="passwordbox">
                            <i class='bx bxs-hide' ></i>
                            <input type="password" class="password col-8" name="password" placeholder="Password">
                            <br>
                            @if($errors->has('password')) 
                                <span class="error col-12"><i class='bx bx-error-circle errorCircle'></i> {{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>

                    <input type="submit" name="login" class="loginbtn col-5" value="Login">

                    <div class="rememberMe">
                        <input type="checkbox" name="rem" class="rememberbox">
                        <label for="rem">Remember me for 30 days</label>
                    </div>

                    <div class="link-to-signup">
                        <p>Don't have an account? <br> <a href="{{route('register')}}" class="createacc">Create account</a></p> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>