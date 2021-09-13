<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Report;
use App\Resep;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail');

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $this->validate($request, [
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date'
            ]);

            $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

            $orders = $orders->whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            //JIKA START DATE & END DATE KOSONG, MAKA DI-LOAD 10 DATA TERBARU
            // $mulai = date('Y-m-d') . ' 00:00:01';
            // $selesai = date('Y-m-d') . ' 23:59:59';
            // $orders = $orders->take(20)->skip(0)->whereBetween('created_at', [$mulai, $selesai])->get();
            $orders = $orders->take(20)->skip(0)->get();
        }

        return view('orders.index', [
            'orders' => $orders,
            'sold' => $this->countItem($orders),
            'total' => $this->countTotal($orders)
        ]);
    }

    private function countTotal($orders)
    {
        //DEFAULT TOTAL BERNILAI 0
        $total = 0;
        //JIKA DATA ADA
        if ($orders->count() > 0) {
            //MENGAMBIL VALUE DARI TOTAL -> PLUCK() AKAN MENGUBAHNYA MENJADI ARRAY
            $sub_total = $orders->pluck('total')->all();
            //KEMUDIAN DATA YANG ADA DIDALAM ARRAY DIJUMLAHKAN
            $total = array_sum($sub_total);
        }
        return $total;
    }

    private function countItem($orders)
    {
        //DEFAULT DATA 0
        $data = 0;
        //JIKA DATA TERSEDIA
        if ($orders->count() > 0) {
            //DI-LOOPING
            foreach ($orders as $row) {
                //UNTUK MENGAMBIL QTY
                $qty = $row->order_detail->pluck('qty')->all();
                //KEMUDIAN QTY DIJUMLAHKAN
                $val = array_sum($qty);
                $data += $val;
            }
        }
        return $data;
    }

    public function invoicePdf($invoice)
    {
        $order = Order::where('invoice', $invoice)->with('order_detail', 'order_detail.product')->first();

        $pdf = PDF::setOptions(['dpi' => 120])
            ->loadView('orders.report.receipt', compact('order'));


        return $pdf->stream();
    }

    public function invoiceExcel($invoice)
    {
    }

    public function addOrder()
    {
        $products = Product::orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('orders.add', compact('products'));
    }

    public function checkout()
    {
        return view('orders.checkout');
    }

    public function getProduct($id)
    {
        $products = Product::findOrFail($id);
        return response()->json($products, 200);
    }

    public function addToCart(Request $request)
    {
        //validasi data yang diterima
        //dari ajax request addToCart mengirimkan product_id dan qty
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer'
        ]);


        //mengambil data product berdasarkan id
        $product = Product::findOrFail($request->product_id);
        //mengambil cookie cart dengan $request->cookie('cart')
        $getCart = json_decode($request->cookie('cart'), true);

        //jika datanya ada
        if ($getCart) {
            //jika key nya exists berdasarkan product_id
            if (array_key_exists($request->product_id, $getCart)) {
                //jumlahkan qty barangnya
                $getCart[$request->product_id]['qty'] += $request->qty;
                //dikirim kembali untuk disimpan ke cookie
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            }
        }


        //jika cart kosong, maka tambahkan cart baru
        $getCart[$request->product_id] = [
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->qty
        ];
        //kirim responsenya kemudian simpan ke cookie
        return response()->json($getCart, 200)
            ->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart()
    {
        //mengambil cart dari cookie
        $cart = json_decode(request()->cookie('cart'), true);
        //mengirimkan kembali dalam bentuk json untuk ditampilkan dengan vuejs
        return response()->json($cart, 200);
    }

    public function getAmmount()
    {
        //mengambil cart dari cookie
        $cart = json_decode(request()->cookie('cart'), true);
        $result = collect($cart)->map(function ($value) {
            return [
                'code' => $value['code'],
                'name' => $value['name'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'result' => $value['price'] * $value['qty']
            ];
        })->all();

        $total = array_sum(array_column($result, 'result'));
        //mengirimkan kembali dalam bentuk json untuk ditampilkan dengan vuejs
        return response()->json($total, 200);
    }

    public function removeCart($id)
    {
        $cart = json_decode(request()->cookie('cart'), true);
        //menghapus cart berdasarkan product_id
        unset($cart[$id]);
        //cart diperbaharui
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }

    public function storeOrder(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'paid' => 'required'
        ]);

        //mengambil list cart dari cookie
        $cart = json_decode($request->cookie('cart'), true);
        //memanipulasi array untuk menciptakan key baru yakni result dari hasil perkalian price * qty
        $result = collect($cart)->map(function ($value) {
            return [
                'code' => $value['code'],
                'name' => $value['name'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'result' => $value['price'] * $value['qty']
            ];
        })->all();

        $total = array_sum(array_column($result, 'result'));
        //database transaction
        DB::beginTransaction();
        try {


            //menyimpan data ke table orders
            $order = Order::create([
                'invoice' => $this->generateInvoice(),
                'customer' => $request->name,
                'table' => $request->table,
                'catatan' => $request->catatan,
                'paid' => $request->paid,
                'user_id' => auth()->user()->id,
                'total' => $total
                //array_sum untuk menjumlahkan value dari result
            ]);

            //looping cart untuk disimpan ke table order_details
           
            foreach ($result as $key => $row) {
                
                $product = Product::where('code',$row['code'])->first();
                $reseps = Resep::where('code', $row['code'])->first()->resepMat;
                foreach($reseps as $resep => $resMat){
                    $resMat->material->stock -= 1 * $row['qty'];
                    $resMat->material->save();
                }

                $order->order_detail()->create([
                    'product_id' => $key,
                    'qty' => $row['qty'],
                    'price' => $row['price']
                    
                ]);

                // $ordermaterial = Resep::join('products', 'products.code', '=', 'reseps.code')
                // ->join('resep_details','resep_details.id_reseps','=','reseps.id')
                // ->join('materials','materials.id','=','resep_details.id_material')->where('reseps.code','=',$key)->get();
                // foreach($ordermaterial as $d =>$row1){
                //     $change=($row1['stock']-$row['qty']);
                //     var_dump($change);
                //     DB::table('materials')
                //      ->where('id', $key)
                //     ->update(['stock' => $change]);
                //     // $ordermaterial=update(['materials.stock' => $change]);
                // }       
                // $ordermaterial = Order_detail::join('products', 'products.code', '=', 'order_details.product_id')
                // ->join('resep','resep.code','=','products.code')
                // ->join('resep_details','resep_details.id_reseps','=','reseps.id')->
                // where('order_details.product_id','=',$key)->get();
                
                
                

                // $bahan=Material::where('product_id',$key)->first();
                // $bahan->update([
                //         'stock' =>$bahan->stock-$row['qty'],
                //  ]);
            }
            //apabila tidak terjadi error, penyimpanan diverifikasi
            DB::commit();


            //me-return status dan message berupa code invoice, dan menghapus cookie
            return response()->json([
                'status' => 'success',
                'message' => $order->invoice,
            ], 200)->cookie(Cookie::forget('cart'));
        } catch (\Exception $e) {
            //jika ada error, maka akan dirollback sehingga tidak ada data yang tersimpan
            DB::rollback();
            //pesan gagal akan di-return
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with(['message' => 'Order Telah Dihapus']);
    }


    public function generateInvoice()
    {
        //mengambil data dari table orders
        $order = Order::orderBy('created_at', 'DESC');
        //jika sudah terdapat records
        if ($order->count() > 0) {
            //mengambil data pertama yang sdh dishort DESC
            $order = $order->first();
            //explode invoice untuk mendapatkan angkanya
            $explode = explode('-', $order->invoice);
            $hasil = 'INV-' . ($explode[1] + 1);
            //angka dari hasil explode di +1
            return $hasil;
        }
        //jika belum terdapat records maka akan me-return INV-1
        return 'INV-1';
    }
}
