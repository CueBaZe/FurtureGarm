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
                        <div class="text-end">
                            <form action="{{ route('timecapsuleDelete') }}" method="POST">
                                @csrf
                                <input type="text" name="id" value="{{ $timecapsule->id }}" hidden>
                                <button class="btn" type="submit"><i class='bx bx-trash' id="delete"></i></button>
                            </form>
                        </div>
                        <h3>{{ $timecapsule->name }}</h3>
                        @if($timecapsule->time <= $currentTime)
                            <p>Opened on {{ $timecapsule->time }}</p>
                        @else 
                            <p>Opens at {{ $timecapsule->time }}</p>
                        @endif
                        <div class="container mb-3">
                            <div class="row justify-content-center">
                                @if($timecapsule->time <= $currentTime)
                                <button onclick='openModal(@json($timecapsule))' data-bs-toggle="modal" data-bs-target="#seeTimecapsule" id="opened" class="openbtn col-7" name="open">Open</button>
                                @else
                                <button id="closed" class="openbtn col-7" name="open">Open</button>
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
                <button class="btn createbtn" data-bs-toggle="modal" data-bs-target="#createTimeCapsule">Create one</button>
            </div>
        </div>
    </div>
    @endif

    <div id="seeTimecapsule" class="modal fade" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header rounded-top">
                    <h5 class="modal-title mx-auto" id="modal-title">
                        <i class="bx bx-time logo"></i>
                        <span id="modal-title-text"></span>
                    </h5>
                    <i class='bx bx-x-circle close' data-bs-dismiss="modal"></i>
                </div>
    
                <div class="modal-body text-center">
                    <p class="lead">Because some messages are meant for later. ⌛</p>
                    <!-- You can replace this with your form later -->
                        <div class="container">
                            <div class="row justify-content-center">
                                <textarea name="text" id="capsuleText" rows="5" readonly></textarea>
                                <p class="mt-4">Was made: <span id="timeMade"></span></p>
                            </div>
                        </div>
                </div>
    
                <div class="modal-footer justify-content-between px-4">
                </div>
            </div>
        </div>
    </div>

    
    @php
    $capsuleData = [
        'name' => $timecapsule->name,
        'text' => $timecapsule->text,
        'created_at' => $timecapsule->created_at,
    ];
    @endphp


@endsection

