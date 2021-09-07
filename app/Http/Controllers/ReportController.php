<?php

namespace App\Http\Controllers;

use App\Order;
use App\Report;
use Illuminate\Http\Request;
use PDF;
use Storage;
use Dompdf\Dompdf;

class ReportController extends Controller
{
    public function index()
    {

        $report = Report::orderBy('created_at', 'DESC')->paginate(10);
        return view('report.index', compact('report'));
    }

    public function store(Request $request)
    {

        try {
            $image = array();
            if (is_array($request->image)) {
                foreach ($request->image as $key => $val) {
                    $uploaded = Storage::disk('public_uploads')->put("/laporan", $val);
                    if ($uploaded) {
                        $image[$key] = $uploaded;
                    }
                }
            } else {
                $uploaded = Storage::disk('public_uploads')->put("/laporan", $request->image);
                if ($uploaded) {
                    $image[] = $uploaded;
                }
            }
            Report::firstOrCreate([
                'total' => $request->total,
                'description' => $request->description,
                'start_date' => $request->start_date . ' 00:00:01',
                'end_date' => $request->end_date . ' 23:59:59',
                'image' => json_encode($image),
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
            'image' => 'required'
        ]);


        try {
            //select data berdasarkan id
            $report = Report::findOrFail($id);
            //update data
            $report->update([
                'total' => $request->total,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'image' => $request->image
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

        if (is_array(json_decode($report->image, TRUE))) {
            $image = array();
            foreach (json_decode($report->image, TRUE) as $key) {
                $image[] = Storage::disk('public_uploads')->get($key);
            }
        } else {
            $image = Storage::disk('public_uploads')->get($report->image);
        }
        $pdf = PDF::setOptions(['dpi' => 120], ['isRemoteEnabled' => true], ['DOMPDF_ENABLE_REMOTE' => true],  ['isHtml5ParserEnabled' => true], ['isPhpEnabled' => true], ['isJavascriptEnabled' => true])
            ->loadView('report.invoice', compact('report', 'orders', 'total', 'image'));
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
