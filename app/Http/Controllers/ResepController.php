<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Resep;
use App\Resep_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResepController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == "barista") {
            $products = Product::with('category')->orderBy('created_at', 'DESC')->where('category_id', 1)->get();
        } else if (auth()->user()->role == "dapur") {
            $products = Product::with('category')->orderBy('created_at', 'DESC')->where('category_id', 2)->get();
        } else {
            $products = Product::with('category')->orderBy('created_at', 'DESC')->get();
        }

        return view('produk.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //validasi data
        $this->validate($request, [
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                if ($request->hasFile('photo')) {
                    //maka menjalankan method saveFile()
                    $photo = $this->saveFile($request->name, $request->file('photo'));
                }
            }

            //Simpan data ke dalam table products
            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);

            //jika berhasil direct ke produk.index
            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //query select berdasarkan id
        $products = Product::findOrFail($id);
        //mengecek, jika field photo tidak null / kosong
        if (!empty($products->photo)) {
            //file akan dihapus dari folder uploads/produk
            File::delete(storage_path('app/public/products/' . $products->photo));
        }
        //hapus data dari table
        $products->delete();
        return redirect()->back()->with(['success' => '<strong>' . $products->name . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        //query select berdasarkan id
        $products = Resep::join('products', 'products.code', '=', 'reseps.code')
                ->join('resep_details','resep_details.id_reseps','=','reseps.id')
                ->join('materials','materials.id','=','resep_details.id_material')->where('reseps.code','=',$id)->get();
        // return compact('products');
                return view('produk.resepproduk', compact('products'));
    }

    public function update(Request $request, $id)
    {
        //validasi
        $this->validate($request, [
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'status' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //query select berdasarkan id
            $product = Product::findOrFail($id);
            $photo = $product->photo;


            //cek jika ada file yang dikirim dari form
            if ($request->hasFile('photo')) {
                //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
                !empty($photo) ? File::delete(storage_path('app/public/products/' . $photo)) : null;
                //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }


            //perbaharui data di database
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);

            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = Str::slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/products', $images);

        //mengembalikan nama file yang ditampung divariable $images
        return $images;
    }
}