@extends('layouts.layout')

@section('title') Home Page @endsection

@section('page-content') 
<link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
    @if ($hasTimeCapsule)
        <div class="container createText">
            <div class="row justify-content-center">
                You have a timeCapsule :D
                <!--Make timeCapsules show here-->
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