@extends('layouts.layout')

@section('title') Home Page @endsection

@section('page-content') 
<link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    @if ($hasTimeCapsule)
        <div class="container haveCapsule">
            <div class="row">
                <h3 class="headtitle">Your <i class='bx bx-time logo'></i> Capsules:</h3>
                @foreach ($timeCapsules as $timecapsule)
                    <div class="capsuleCard text-center col-10 col-md-4 col-lg-3">
                        <h3>{{ $timecapsule->name }}</h3>
                        @if($timecapsule->time <= $currentTime)
                            <p>Opened on {{ $timecapsule->time }}</p>
                        @else 
                            <p>Opens at {{ $timecapsule->time }}</p>
                        @endif
                        <div class="container mb-3">
                            <div class="row justify-content-center">'
                                @if($timecapsule->time <= $currentTime)
                                <a href="#" id="opened" class="openbtn col-4" name="open" data-id="{{ $timecapsule->id }}">Open</a>
                                @else
                                <a href="#" id="closed" class="openbtn col-4" name="open" data-id="{{ $timecapsule->id }}">Open</a>
                                @endif
                            </div>
                        </div>
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