@extends('layouts.dashboard')

@section('title', 'Data Transaksi')

@push('css')
    <link rel="stylesheet" href="/package/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/package/select2/dist/css/select2.min.css">
@endpush

@section('content')
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Transaksi</a></div>
            <div class="breadcrumb-item">Transaksi</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Kelola Data Transaksi</h4>
                        <div class="card-header-action">
                            <a class="btn btn-primary" href="/dashboard/transaksi/create">Tambah
                                Transaksi</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>No Invoice</th>
                                        <th>Konsumen</th>
                                        <th>Nama Paket</th>
                                        <th>Tipe Pembayaran</th>
                                        <th>Status</th>
                                        <th>Berat</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Estimasi Selesai</th>
                                        <!-- <th>Tanggal Diambil</th> -->
                                        <th>Status Pembayaran</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->invoice }}</td>
                                            <td>{{ $item->konsumen->nama }}</td>
                                            <td>{{ $item->paket->nama }}</td>
                                            <td>{{ $item->tipe_pembayaran->nama }}</td>
                                            <td>{{ $item->status_pesanan->nama }}</td>
                                            <td>{{ $item->berat }}</td>
                                            <td>{{ $item->tanggal_masuk }}</td>
                                            <td>{{ $item->tanggal_keluar }}</td>
                                            <!-- <td>{{ $item->tanggal_diambil ?? "Belum Di Ambil" }}</td> -->
                                            <td>
                                            @if($item->status_bayar)
                                                    <span class="badge bg-success text-white">
                                                        DIBAYAR
                                                    </span>
                                            @else
                                                    <span class="badge bg-danger text-white">
                                                        BELUM DIBAYAR
                                                    </span>
                                            @endif
                                            </td>
                                            <td>{{ $item->diskon }}</td>
                                            <td>{{ $item->total_bayar }}</td>
                                            <td>{{ 'Hutang Rp. ' . number_format(json_decode($item->keterangan, true)['hutang']) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" onclick="submitUpdateStatus({{ $item->id }})" href="#"><i class="fa-solid fa-pen-to-square text-primary pr-2"></i>Ubah</a>
                                                        @if($item->status_bayar)
                                                        <a class="dropdown-item" href="/dashboard/transaksi/invoice?invoice={{ $item->invoice }}"><i class="fa-solid fa-file-invoice text-warning pr-2"></i>Invoice</a>                                                        
                                                        @endif
                                                        <form action="{{ route('transaksi.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            {{-- create tag a with onclick submit with alert --}}
                                                            <a class="dropdown-item" href="#"
                                                                onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-trash text-danger pr-2"></i> Hapus</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="formChangeStatus" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Pilih Status Pesanan</label>
                            <select class="form-control select2" id="select_konsumen" name="status_pesanan_id">
                                <option>Pilih Status Pesanan</option>
                                @foreach ($status_pesanan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="select_bayar">
                                                <label>Pilih Status Bayar</label>
                                                <select class="form-control select2" name="status_bayar">
                                                      <option>Pilih Status Bayar</option>
                                                      <option value="1">Bayar</option>
                                                      <option value="0">Belum Bayar</option>
                                                </select>
                                          </div>
                        <div class="modal-footer br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hapus</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endpush

@push('js')
<script src="/package/select2/dist/js/select2.full.min.js"></script>
    <script src="/package/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/package/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/page/modules-datatables.js"></script>

    <script>
        // function submitUpdateStatus(id) {
        //     $('#formChangeStatus').attr('action', '/dashboard/transaksi/' + id);
        //     $('#modalUpdate').modal('show');
        // }
        function submitUpdateStatus(id, status_bayar) {
                  $('#formChangeStatus').attr('action', '/dashboard/transaksi/' + id);
                  if(status_bayar == 0){
                        console.log(status_bayar);
                        document.getElementById("select_bayar").style.display = "block";
                  } else if(status_bayar == 1) {
                        console.log(status_bayar);
                        document.getElementById("select_bayar").style.display = "none";
                  }
                  $('#modalUpdate').modal('show');
            }
    </script>
@endpush
