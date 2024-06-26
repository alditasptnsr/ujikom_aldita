<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Konsumen;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\StatusPesanan;
use App\Models\TipePembayaran;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        $status_pesanan = StatusPesanan::all();
        return view('transaksi.index', compact('transaksi', 'status_pesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $konsumen = Konsumen::all();
        $paket = Paket::all();
        $tipe_pembayaran = TipePembayaran::all();


        return view('transaksi.create', compact('konsumen', 'paket', 'tipe_pembayaran'));
    }

    public function printInvoice(Request $request)
    {
        return view('transaksi.invoice', [
            'invoice' => Transaksi::where('invoice', $request->invoice)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "id_konsumen" => "required",
            "id_paket" => "required",
            "berat" => "required",
            "tanggal_masuk" => "required",
            "tanggal_keluar" => "required",
            "id_tipe_pembayaran" => "required",
            "status" => "required",
            "invoice" => "required|unique:transaksi",
            "diskon" => "required",
            "total_bayar" => "required",
        ]);

        Transaksi::create([
            "id_konsumen" => $request->id_konsumen,
            "paket_id" => $request->id_paket,
            "id_karyawan" => Auth::user()->id,
            "tanggal_masuk" => $request->tanggal_masuk,
            "tanggal_keluar" => $request->tanggal_keluar,
            "status_pesanan_id" => StatusPesanan::first()->id,
            "tipe_pembayaran_id" => $request->id_tipe_pembayaran,
            "status_bayar" => $request->status,
            "invoice" => $request->invoice,
            "diskon" => $request->diskon,
            "berat" => $request->berat,
            "total_bayar" => $request->total_bayar,
            'keterangan' => json_encode([
                'hutang' => $request->status_bayar == 1 ? $request->hutang : $request->total_bayar,
            ])
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi Pesanan Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        if($request->status_pesanan_id != 'Pilih Status Pesanan'){
            $transaksi->status_pesanan_id = $request->status_pesanan_id;
        }
        if($request->status_bayar != 'Pilih Status Bayar'){
            $transaksi->status_bayar = $request->status_bayar;
            $transaksi->keterangan = json_encode([
                'hutang' => "0"
            ]);
        }        $transaksi->save();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi Pesanan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi Pesanan berhasil dihapus');
    }
}
