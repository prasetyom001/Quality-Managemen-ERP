<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Tampilkan dashboard + list
    public function index()
    {
        $materials = Material::latest()->paginate(10);

        $total_baik = Material::where('kondisi', 'baik')->sum('jumlah');
        $total_rusak = Material::where('kondisi', 'rusak')->sum('jumlah');
        $count_baik = Material::where('kondisi', 'baik')->count();
        $count_rusak = Material::where('kondisi', 'rusak')->count();

        return view('materials.index', compact('materials', 'total_baik', 'total_rusak', 'count_baik', 'count_rusak'));
    }

    // form create
    public function create()
    {
        return view('materials.create');
    }

    // simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'kondisi' => 'required|in:baik,rusak',
            'jumlah' => 'required|integer|min:1',
        ]);

        Material::create($request->only('nama_bahan','kondisi','jumlah'));

        return redirect()->route('materials.index')->with('success', 'Data material berhasil ditambahkan.');
    }

    // form edit
    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    // update
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'kondisi' => 'required|in:baik,rusak',
            'jumlah' => 'required|integer|min:1',
        ]);

        $material->update($request->only('nama_bahan','kondisi','jumlah'));

        return redirect()->route('materials.index')->with('success', 'Data material berhasil diperbarui.');
    }

    // delete
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Data material berhasil dihapus.');
    }

    // optional show
    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }
}
