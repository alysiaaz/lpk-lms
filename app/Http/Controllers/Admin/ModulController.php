<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index($kursusId) {
    $kursus = \App\Models\Kursus::findOrFail($kursusId);
    $moduls = \App\Models\Modul::where('kursus_id', $kursusId)->orderBy('urutan')->get();
    
    return view('admin.modul.index', compact('kursus', 'moduls'));
    }
}
