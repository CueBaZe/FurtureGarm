@extends('layouts.layout')

@section('title') Home Page @endsection

@section('page-content') 
<link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    @if ($hasTimeCapsule)
        <div class="container haveCapsule">
            <div class="row">
                @foreach ($timeCapsules as $timecapsule)
                    <div class="capsuleCard col-12 col-md-4 col-lg-3 text-center">
                        <h3>{{ $timecapsule->name }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    @else
    <div class="container createText">
        <div class="row justify-content-center">
            <div class="box text-center">
                <i class='bx bx-error-circle error'></i>
                <h3>HEY!!!</h3>
                <p>You dont have an timecapsule!</p>
                <button class="btn createbtn" data-toggle="modal" data-target="#createTimeCapsule">Create one</button>
            </div>
        </div>
    </div>
    @endif
    
@endsection