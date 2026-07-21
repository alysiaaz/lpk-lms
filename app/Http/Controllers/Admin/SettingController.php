<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit() {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tentang_visi' => 'required|string',
            'tentang_misi' => 'required|string',
            'tentang_sejarah' => 'nullable|string',
            'tentang_keunggulan' => 'nullable|string',
            'tentang_alamat' => 'nullable|string',
            'tentang_telepon' => 'nullable|string|max:30',
            'tentang_email' => 'nullable|email|max:255',
            'tentang_jam_operasional' => 'nullable|string|max:255',
        ]);

        foreach ($request->only([
            'tentang_visi',
            'tentang_misi',
            'tentang_sejarah',
            'tentang_keunggulan',
            'tentang_alamat',
            'tentang_telepon',
            'tentang_email',
            'tentang_jam_operasional',
        ]) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Konten berhasil diperbarui');
    }
}
