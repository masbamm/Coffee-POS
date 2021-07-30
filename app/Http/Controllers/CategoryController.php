<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $adas = Category::all();

        try {
            foreach ($adas as $ada) {
                if ($ada->name == $request->name) {
                    return redirect()->back()->with(['error' => 'kategori: ' . $ada->name . ' sudah ada']);
                }
            }
            $categories = Category::firstOrCreate([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'kategori: ' . $categories->name . ' Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        $adas = Category::all();



        try {
            foreach ($adas as $ada) {
                if ($ada->name == $request->name) {
                    return redirect()->back()->with(['error' => 'kategori: ' . $ada->name . ' sudah ada']);
                }
            }
            //select data berdasarkan id
            $categories = Category::findOrFail($id);
            //update data
            $categories->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            //redirect ke route kategori.index
            return redirect(route('kategori.index'))->with(['success' => 'Data telah Diupdate']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with(['success' => 'Kategori: ' . $categories->name . ' Telah Dihapus']);
    }
}