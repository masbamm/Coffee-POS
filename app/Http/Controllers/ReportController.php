<?php

namespace App\Http\Controllers;

use App\Order;
use App\Report;
use Illuminate\Http\Request;
use PDF;
use Storage;

class ReportController extends Controller
{
    public function index()
    {

        $report = Report::orderBy('created_at', 'DESC')->paginate(10);
        return view('report.index', compact('report'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'total' => 'required|integer',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        try {
            $request->image = preg_replace('#^data:image/\w+;base64,#i', '', $request->image);
            $foto = md5($request->image."_".date('Y-m-d H:i:s')) . '.jpg';
            if(Storage::disk('public_uploads')->put("/laporan/". $foto, base64_decode($request->image))){
                $request->image = "data/izin/".$foto;
                }     
           else{
                unset($request->image);
            }

            Report::firstOrCreate([
                'total' => $request->total,
                'description' => $request->description,
                'start_date' => $request->start_date . ' 00:00:01',
                'end_date' => $request->end_date . ' 23:59:59',
                'image' => $request->image,
            ]);
            return redirect()->back()->with(['success' => 'Laporan Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('report.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'total' => 'required|integer',
            'description' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        try {
            //select data berdasarkan id
            $report = Report::findOrFail($id);
            //update data
            $report->update([
                'total' => $request->total,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            //redirect ke route kategori.index
            return redirect(route('report.index'))->with(['success' => 'Data telah Diupdate']);
        } catch (\Exception $e) {
            //jika gagal, redirect ke form yang sama lalu membuat flash message error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->back()->with(['success' => 'Report Telah Dihapus']);
    }

    public function invoicePdf($id)
    {
        $report = Report::where('id', $id)->first();
        $orders = Order::orderBy('created_at', 'ASC')->whereBetween('created_at', [$report->start_date, $report->end_date])->get();

        $total = $this->countTotal($orders);

        $pdf = PDF::setOptions(['dpi' => 120])
            ->loadView('report.invoice', compact('report', 'orders', 'total'));
        return $pdf->stream();
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
}