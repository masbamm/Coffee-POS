@extends('layouts.pdf')

@section('title', $order->invoice)

@section('style')
    <style>
        table.receipt-table {
            width: 300px;
            border-collapse: collapse;
            font-size: 7px;

        }

        table.text{
            text-align: center;
        }
        @page { size: 8cm 8cm portrait; }

    </style>
@endsection

@section('content')

    <table class="receipt-table">
        <tbody>

            <tr>
                <td colspan="3" class="text-right">
                    <h2 class="text-right" style="text-align:center">Cafe Akustik</h2>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p class="text-center" style="text-align:center">Jln. Pembangunan No. 37, Garut</p>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="width:90px">No.Invoice</td>
                <td class="strong">: {{ $order->invoice }}</td>
                <td colspan="2" class="text-right">{{ $order->created_at->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: {{ $order->user->name }}</td>
                <td colspan="2" class="text-right">{{ $order->created_at->format('H:i:s') }}</td>
            </tr>
            <tr>
                <td>Customer</td>
                <td colspan="2">: {{ $order->customer }}</td>
            </tr>
            <tr>
                <td>No Meja</td>
                <td colspan="2">: {{ $order->table }}</td>
            </tr>
        </tbody>
    </table>
    <table class="receipt-table">
        <tbody>
            <tr>
                <td colspan="2"><b>Barang Belanja</b></td>
            </tr>
            <thead>
                <tr class="border-bottom">
                    <td>#</td>
                    <td>Produk</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Sub Total</td>
                </tr>
            </thead>
            @php
                $no = 1;
                $totalPrice = 0;
                $totalQty = 0;
                $total = 0;
                $kembali = 0;
            @endphp
            @forelse ($order->order_detail as $row)
        <tbody>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->product->name }}</td>
                <td>
                    Rp {{ number_format($row->price) }}
                </td>
                <td>
                    {{ $row->qty }} Item
                </td>
                <td>Rp {{ number_format($row->price * $row->qty) }}</td>
            </tr>
        </tbody>
        @php
            $totalPrice += $row->price;
            $totalQty += $row->qty;
            $total += $row->price * $row->qty;
            $kembali = $order->paid - $total;
        @endphp
    @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
        <tr class="border-top">
            <td><b>Catatan :</b></td>
            <td colspan="4"><b> {{$order->catatan}}</b></td>
        </tr>
        <tr class="border-top">
            <td colspan="4"><b>Total :</b></td>
            <td><b>Rp {{ number_format($total) }}</b></td>
        </tr>
        <tr>
            <td colspan="4"><b>Bayar :</b></td>
            <td><b>Rp {{ number_format($order->paid) }}</td>
        </tr>
        <tr>
            <td colspan="4"><b>Kembali :</b></td>
            <td><b>Rp {{ number_format($kembali) }}</b></td>
        </tr>
        <tr>
            <td colspan="4">
            <h3 class="text-center" style="text-align:center"> Terimakasih Atas Kunjungan Anda<h3>
    </td>
        </tr>
        </tbody>
    </table>
@endsection
