<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function saveSettings(Request $request) {

        $request->validate([
            'background' => "hex_color",
            'titleColor' => "hex_color",
            'textColor' => "hex_color",
            'btnopColor' => "hex_color",
            'btnopTextColor' => "hex_color",
            "btnclColor" => "hex_color",
            "btnclTextColor" => "hex_color",
            'deleteColor' => "hex_color",
        ]);

        $user = Auth::user();

        $setting = Setting::where('user_id', $user->id)->first();

        $setting->update([
            'showOpen' => $request->has('showOpen'),
            'showCountdown' => $request->has('showCountdown'),
            'showMadeBy' => $request->has('showMadeBy'),
            'background' => $request->input('background'),
            'titleColor' => $request->input('titleColor'),
            'textColor' => $request->input('textColor'),
            'buttonColor' => $request->input('btnopColor'),
            'buttonText' => $request->input('btnopTextColor'),
            'buttonclColor' => $request->input('btnclColor'),
            'buttonclText' => $request->input('btnclTextColor'),
            'deleteColor' => $request->input('deleteColor'),
        ]);

        return redirect()->back();

    }
}
