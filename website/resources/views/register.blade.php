<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <title>Register Page</title>
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
                <form action="{{ route('registerpost') }}" method="POST">
                    @csrf
                    <div class="inputs">

                        <div class="namebox">
                            <i class='bx bx-purchase-tag-alt'></i>
                            <input type="text" name="name" class="name col-8" placeholder="Nametag">
                            <br>
                            @if($errors->has('name'))
                                <span class="error col-12"><i class='bx bx-error-circle errorCircle'></i> {{$errors->first('name')}}</span>
                            @endif
                        </div>

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

                    <input type="submit" name="register" class="registerbtn col-5" value="Register">

                    <div class="termsbox">
                        <input type="checkbox" name="terms" class="term">
                        <label for="terms">Accept terms and conditions</label>
                        <br>
                        @if($errors->has('terms'))
                            <span class="error col-12"><i class='bx bx-error-circle errorCircle'></i> {{$errors->first('terms')}}</span>
                        @endif
                    </div>

                    <div class="link-to-signup">
                        <p>Already have an account? <br> <a href="{{route('login')}}" class="signin">Sign in</a></p> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>