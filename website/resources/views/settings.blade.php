@extends('layouts.layout')

@section('title')Settings @endsection

@section('page-content')

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Setting;

    $setting = Setting::where('user_id', Auth::id())->first();
@endphp

<link href="{{ asset('css/settings.css') }}" rel="stylesheet">

<div class="container cardContainer">
    <div class="row">
        <div class="settingsCard">
            <div class="cardTitleContainer text-center mt-4">
                <h3 class="cardTitle">Settings</h3>
            </div>
            <form action="{{ route('saveSetting') }}" method="POST">
                @csrf
                <div class="cardBodyContainer text-center">
                    <div class="timecapsuleSettings">
                        <h3 class="settingsTitle">Timecapsule Settings</h3>
                        <div class="container">
                            <div class="row">
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Show when timecapsule opens/opened:</p>
                                    <input type="checkbox" name="showOpen" class="offscreen" id="showtimecapsuleopen" @if($setting->showOpen == true) checked @endif>
                                    <label for="showtimecapsuleopen" class="switch mb-0"></label>
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Show timecapsule countdown:</p>
                                    <input type="checkbox" name="showCountdown" class="offscreen" id="showtimecapsulecountdown" @if($setting->showCountdown == true) checked @endif>
                                    <label for="showtimecapsulecountdown" class="switch mb-0"></label>
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Show who made the timecapsule:</p>
                                    <input type="checkbox" name="showMadeBy" class="offscreen" id="showtimecapsulemade" @if($setting->showMadeBy == true) checked @endif>
                                    <label for="showtimecapsulemade" class="switch mb-0"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="DesignSettings mt-4">
                        <h3 class="settingsTitle">Design Settings</h3>
                        <div class="container">
                            <div class="row">
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule background color:</p>
                                    <input type="color" name="background" id="timecapsuleBackgroundColor" value="{{ $setting->background ?? '#f9f9f9' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule title color:</p>
                                    <input type="color" name="titleColor" id="timecapsuleTitleColor" value="{{ $setting->titleColor ?? '#000000' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule text color:</p>
                                    <input type="color" name="textColor" id="timecapsuleTextColor" value="{{ $setting->textColor ?? '#515151' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule opened button color:</p>
                                    <input type="color" name="btnopColor" id="buttonColor" value="{{ $setting->buttonColor ?? '#ff4d00' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule opened button text color:</p>
                                    <input type="color" name="btnopTextColor" id="buttonTextColor" value="{{ $setting->buttonText ?? '#f9f9f9' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule closed button color:</p>
                                    <input type="color" name="btnclColor" id="buttonclColor" value="{{ $setting->buttonclColor ?? '#515151' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule closed button text color:</p>
                                    <input type="color" name="btnclTextColor" id="buttonclTextColor" value="{{ $setting->buttonclText ?? '#f9f9f9' }}">
                                </div>
                                <div class="settingOption d-flex justify-content-center align-items-center gap-2 mt-3">
                                    <p class="mb-0">Timecapsule delete button color:</p>
                                    <input type="color" name="deleteColor" id="deletecolor" value="{{ $setting->deleteColor ?? '#ff0000' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cardFooterContainer d-flex justify-content-between">
                    <a href="{{ route('settings') }}" class="cancelSettingsBtn" style="text-decoration: none;">Cancel</a>
                    <a href="{{ route('resetSetting') }}" class="resetToDefualt" style="text-decoration: none;">Reset settings</a>
                    <button type="submit" class="saveSettingsBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection