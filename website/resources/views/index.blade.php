<script>
    const mediaRoute = "{{ url('/get-media') }}";
</script>
@extends('layouts.layout')

@section('title') Home Page @endsection

@section('page-content') 

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Setting;

    $setting = Setting::where('user_id', Auth::id())->first();
@endphp

<link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    @if ($hasTimeCapsule)
        <div class="container haveCapsule">
            <div class="row">
                <h3 class="headtitle">Your <i class='bx bx-time logo'></i> Capsules:</h3>
                @foreach ($timeCapsules as $timecapsule)
                    <div id="capsule-{{ $timecapsule->id }}" class="capsuleCard text-center col-10 col-md-4 col-xl-3" style="background-color: {{ $setting->background  }};">
                        <div class="text-end">
                            <input type="text" name="id" value="{{ $timecapsule->id }}" hidden>
                            <button class="delete-btn btn" type="submit" data-id="{{ $timecapsule->id }}" style="color: {{ $setting->deleteColor }}"><i class='bx bx-trash' id="delete"></i></button>
                        </div>
                        <h3 style="color: {{ $setting->titleColor }}">{{ $timecapsule->name }}</h3>
                        @if( $setting->showOpen  == true) 
                            @if($timecapsule->time <= $currentTime)
                                <p class="p" style="color: {{ $setting->textColor }};">Opened on {{ $timecapsule->time }}</p>
                            @else 
                                <p class="p" style="color: {{ $setting->textColor }};">Opens at {{ $timecapsule->time }}</p>
                            @endif
                        @endif
                        <div class="container mb-3">
                            <div class="row justify-content-center">
                                @if($timecapsule->time <= $currentTime)
                                <button onclick='openModal(@json($timecapsule))' data-bs-toggle="modal" data-bs-target="#seeTimecapsule" id="opened" class="openbtn col-7" name="open" style="background-color: {{ $setting->buttonColor }}; color: {{ $setting->buttonText }}">Open</button>
                                @else
                                <button id="closed" class="openbtn col-7" name="open" style="background-color: {{ $setting->buttonclColor }}; color: {{ $setting->buttonclText }};">Open</button>
                                @endif
                            </div>
                        </div>
                        @if($setting->showMadeBy == true)
                            <p class="p" style="color: {{ $setting->textColor }}">Made by {{ $timecapsule->madeBy }}</p>
                        @endif
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
                <p class="p">You dont have an timecapsule!</p>
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
                    <i class='bx bx-x-circle close' data-bs-dismiss="modal" onclick="closeModal()"></i>
                </div>
    
                <div class="modal-body text-center">
                    <p class="lead">Because some messages are meant for later. ⌛</p>
                        <div class="container">
                            <div class="row justify-content-center">
                                <textarea name="text" id="capsuleText" rows="5" readonly></textarea>
                                <div class="mediaContainer mt-4" id="modal-image">
                                    
                                </div>  
                                <p class="mt-4">Was made: <span id="timeMade"></span></p>
                                <p>Created by: <span id="madeBy"></span></p>
                            </div>
                        </div>
                </div>
    
                <div class="modal-footer justify-content-between px-4">
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/deleteTimecapsule.js') }}"></script>
@endsection

