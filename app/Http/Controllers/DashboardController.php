<?php

namespace App\Http\Controllers;

use App\Material;
use App\Order;
use App\Product;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $order = Order::count();

        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail');
        $penjualan = 0;

        $bahan = Report::orderBy('created_at', 'DESC');
        $pengeluaran = 0;

        if ($orders->count() > 0) {
            $sub_total = $orders->pluck('total')->all();
            $penjualan = array_sum($sub_total);
        }

        if ($bahan->count() > 0) {
            $sub_total_pengeluaran = $bahan->pluck('total')->all();
            $pengeluaran = array_sum($sub_total_pengeluaran);
        }

        $profit = $penjualan - $pengeluaran;

        return view('dashboard.home', compact('product', 'order', 'penjualan', 'pengeluaran', 'profit'));
    }

    public function getChart()
    {
        $start = Carbon::now()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';

        $end = Carbon::now()->format('Y-m-d') . ' 23:59:00';

        $order = Order::select(DB::raw('date(created_at) as order_date'), DB::raw('count(*) as total_order'))
            //DENGAN KONDISI ANTARA TANGGAL YANG ADA DI VARIABLE $start DAN $end 
            ->whereBetween('created_at', [$start, $end])
            //KEMUDIAN DI KELOMPOKKAN BERDASARKAN TANGGAL
            ->groupBy('created_at')
            ->get()->pluck('total_order', 'order_date')->all();

        //LOOPING TANGGAL DENGAN INTERVAL SEMINGGU TERAKHIR
        for ($i = Carbon::now()->subWeek()->addDay(); $i <= Carbon::now(); $i->addDay()) {
            //JIKA DATA NYA ADA 
            if (array_key_exists($i->format('Y-m-d'), $order)) {
                //MAKA TOTAL PESANANNYA DI PUSH DENGAN KEY TANGGAL
                $data[$i->format('Y-m-d')] = $order[$i->format('Y-m-d')];
            } else {
                //JIKA TIDAK, MASUKKAN NILAI 0
                $data[$i->format('Y-m-d')] = 0;
            }
        }
        return response()->json($data);
    }
}