<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $bahan = Material::orderBy('created_at', 'DESC')->paginate(10);

        return view('bahan.index', compact('bahan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'additional' => 'required|string',
        ]);

        try {
            $bahan = Material::firstOrCreate([
                'name' => $request->name,
                'stock' => $request->stock,
                'category' => $request->category,
                'additional' => $request->additional,
            ]);
            return redirect()->back()->with(['success' => 'kategori: ' . $bahan->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $bahan = Material::findOrFail($id);
        return view('bahan.edit', compact('bahan'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'additional' => 'required|string',
        ]);


        try {
            //select data berdasarkan id
            $bahan = Material::findOrFail($id);
            //update data
            $bahan->update([
                'name' => $request->name,
                'stock' => $request->stock,
                'category' => $request->category,
                'additional' => $request->additional,
            ]);

            //redirect ke route bahan.index
            return redirect(route('bahan.index'))->with(['success' => 'Data telah Diupdate']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $bahan = Material::findOrFail($id);
        $bahan->delete();
        return redirect()->back()->with(['success' => 'Bahan: ' . $bahan->name . ' Telah Dihapus']);
    }
}