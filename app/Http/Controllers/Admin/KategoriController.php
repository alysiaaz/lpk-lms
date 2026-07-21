<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = \App\Models\Kategori::all(); 
        return view('admin.kategori.index', compact('kategoris'));
    }
}
