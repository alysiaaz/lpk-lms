<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit() {
        $settings = \App\Models\Setting::all();
        return view('admin.settings.edit', compact ('settings'));
    }

    public function update(Request $request) {
        foreach ($request->except('_token', '_method') as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value => $value']);
        }
        return back()->with('succes','Konten berhasil diperbarui');
    }
}
