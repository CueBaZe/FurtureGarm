@extends ('layouts.layout')
@section('title')Account Infomation @endsection

@section('page-content')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<div class="container card-container d-flex">
    <div class="row justify-content-center">
        <div class="card text-center">
            <div class="text-center">
                <h3 class="title">Account Infomation</h3>
            </div>
            <div>
                @if(session()->has('successAcc'))
                    <div><i class='bx bx-check-circle successcircle'></i> {{session()->get("successAcc")}}</div>
                @endif
            </div>
            <div class="inputs">
                <form action="{{ route('changeAccInfo') }}" method="POST">
                @csrf
                    <div class="nameInput mt-4 mb-4">
                        <i class='bx  bx-user m-2'></i> 
                        <input type="text" class="input" id="name" name="name" placeholder="{{Auth::user()->name}}" value="{{ old('name') }}">
                        @error('name') 
                            <div class="error col-12"><i class='bx bx-error-circle errorCircle'></i> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="emailInput mb-4">
                        <i class='bx  bx-envelope m-2'></i> 
                        <input type="text" class="input" id="email" name="email" placeholder="{{Auth::user()->email}}" value="{{ old('email') }}">
                        @error('email') 
                            <div class="error col-12"><i class='bx bx-error-circle errorCircle'></div> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="passwordInput mb-4">
                        <i class='bx bxs-hide m-2' id="showpass"></i>
                        <input type="password" class="input" id="password" name="password" placeholder="Cant show password!">
                        @error('password') 
                            <div class="error"><i class='bx bx-error-circle errorCircle'></i> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="submitInput">
                        <input type="submit" name="save" class="col-4" id="save" value="Save">
                    </div>
                </form>
                <div class="deleteButton">
                    <a href="#" id="deleteAccBtn" data-bs-toggle="modal" data-bs-target="#sureModal">Delete Account</a>
                </div>
            </div>
        </div>  
    </div>
</div>

<div id="sureModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header rounded-top">
                <h5 class="modal-title mx-auto">
                    Are you sure?
                </h5>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure you want to delete your account?</p>
                <p>This action cannot be undone!!</p>
                <a id="deleteAcc" class="button" style="background-color: red;" href="{{ route('deleteAcc') }}">Delete Account</a>
                <a id="cancelAcc" href="#" class="button" style="background-color: gray;" data-bs-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/showpass.js') }}"></script>
@endsection