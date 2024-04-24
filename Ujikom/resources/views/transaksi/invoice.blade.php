@extends('layouts.dashboard')

@section('title', 'Data Transaksi')

@push('css')
    <link rel="stylesheet" href="/package/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/package/select2/dist/css/select2.min.css">
@endpush

@section('content')
<section class="section">
          <div class="section-header">
            <h1>Struk Pemesanan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Invoice</div>
            </div>
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h2>Hyungdry Laundry</h2>
                      <div class="invoice-number">Order {{ $invoice->invoice }}</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                        Jl. Jend. Sudirman Lingk. Cibeureum No.269, RT.01/RW.09, Sindangrasa, Kec. Ciamis, Kabupaten Ciamis, Jawa Barat 46215<br><br>
                        (0265) 771204
                        </address>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Tanggal Masuk: </strong>
                          {{ $invoice->tanggal_masuk }}<br>
                          <strong>Nama konsumen:</strong>
                          {{ $invoice->konsumen->nama}}<br>
                          <strong>Status:</strong>
                          {{ $invoice->status_pesanan->nama}}
                        </address>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
               
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tbody>
                        <tr>
                          <th data-width="40" style="width: 40px;">No</th>
                          <th>Paket</th>
                          <th>Jenis Paket</th>
                          <th>Harga</th>
                          <th>Berat</th>
                          <th>Jumlah Harga</th>
                        </tr>
                        <tr>
                        <td></td>
                        <td>{{ $invoice->paket->nama }}</td>
                        <td>{{ $invoice->paket->jenis }}</td>
                        <td>{{ $invoice->paket->harga }}</td>
                        <td>{{ $invoice->berat }}</td>
                        <td>{{ $invoice->total_bayar }}</td>
                        <td></td>
                        </tr>
                      </tbody></table>
                      <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                      <button class="btn btn-warning btn-icon icon-left" onclick="window.print();"><i class="fas fa-print"></i> Print</button>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
            </div>
          </div>
        </section>
@endsection