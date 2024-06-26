@extends('layouts.dashboard')

@section('title', 'Data Tipe Pembayaran')

@push('css')
    <link rel="stylesheet" href="/package/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="section-header">
        <h1>Tipe Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Data Reference</a></div>
            <div class="breadcrumb-item">Tipe Pembayaran</div>
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
                        <h4>Kelola Data Tipe Pembayaran</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah
                                Tipe Pembayaran</button>
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
                                        <th>Tipe Pembayaran</th>
                                        <th>No Rekening</th>
                                        <th>Nama Pemilik</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipe_pembayaran as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->no_rekening }}</td>
                                            <td>{{ $row->nama_pemilik }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" data-toggle="modal" href="#edit{{$row->id}}"><i class="fa-solid fa-pen-to-square text-primary pr-2"></i> Edit</a>
                                                        <form action="{{ route('tipe_pembayaran.destroy', $row->id) }}"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Data Tipe Pembayaran Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tipe_pembayaran.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tipe Pembayaran</label>
                            <input type="text" name="nama" class="form-control" required id="recipient-name"
                                placeholder="Debit">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">No Rekening</label>
                            <input type="number" name="no_rekening" class="form-control" required id="message-text"
                                placeholder="xxxxxxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control" required id="message-text"
                            placeholder="Joko">
                        </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($tipe_pembayaran as $data)
    <div class="modal fade" tabindex="-1" role="dialog" id="edit{{$data->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Tipe Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tipe_pembayaran.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nama Tipe Pembayaran</label>
                            <input type="text" name="nama" value="{{$data->nama}}" class="form-control" required id="recipient-name"
                                placeholder="Debit">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">No Rekening</label>
                            <input type="number" name="no_rekening" value="{{$data->no_rekening}}" class="form-control" required id="message-text"
                                placeholder="xxxxxxxxxxx">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" value="{{$data->nama_pemilik}}" class="form-control" required id="message-text"
                            placeholder="Joko">
                        </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    </div>
@endpush

@push('js')
    <script src="/package/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/package/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/page/modules-datatables.js"></script>
@endpush
