@extends('layouts.user.table')
@section('title', 'Data Master | Perusahaan')

@section('breadcrumb-title')
<h3>Perusahaan</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Perusahaan</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" type="button" id="tambah_perusahaan"><i class="fa fa-plus"></i> Tambah Perusahaan</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Perusahaan</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $c)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $c->company_code }}</td>
                                    <td>{{ $c->instansi }}</td>
                                    <td>
                                        <div class="text-center">
                                            <button class="btn btn-warning btn-xs edit" type="button" id="edit_{{ $c->company_id }}"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-primary btn-xs delete" type="button" id="delete_{{ $c->company_id }}"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="tambahPerusahaan" role="dialog" aria-labelledby="tambahPerusahaan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="judul_modal"></h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="" id="formPerusahaan">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Kode <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="company_code" required="required" class="form-control" id="formCompanyCode">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Nama <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="instansi" required="required" class="form-control" id="formInstansi">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePerusahaan" tabindex="-1" role="dialog" aria-labelledby="deletePerusahaan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Hapus Perusahaan</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('admin.perusahaan-delete') }}">
                @csrf
                Apakah Anda yakin ingin menghapus perusahaan <b id="nama_perusahaan"></b> ?
                <br>
                <input type="hidden" name="company_id" id="id_perusahaan">
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Tidak</button>
                <button class="btn btn-primary" type="submit">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
    <script type="text/javascript" src="{{asset('assets/js/custom/data_master_perusahaan.js')}}"></script>
@endsection
