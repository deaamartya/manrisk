@extends('layouts.user.table')
@section('title', 'Data Master | Resiko')

@section('breadcrumb-title')
<h3>Resiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Resiko</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" type="button" id="tambah_resiko"><i class="fa fa-plus"></i> Tambah Resiko</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>Risk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resiko as $r)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $r->id_risk }}</td>
                                    <td>{{ $r->risk }}</td>
                                    <td>
                                        <div class="text-center">
                                            <button class="btn btn-warning btn-xs edit" type="button" id="edit_{{ $r->id_risk }}"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-primary btn-xs delete" type="button" id="delete_{{ $r->id_risk }}"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="tambahResiko" role="dialog" aria-labelledby="tambahResiko" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="judul_modal"></h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="" id="formResiko">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Kode <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="id_risk" required="required" class="form-control" id="formCode">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Resiko <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="risk" required="required" class="form-control" id="formRisk">
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

<div class="modal fade" id="deleteResiko" tabindex="-1" role="dialog" aria-labelledby="deleteResiko" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Hapus Resiko</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('admin.resiko-delete') }}">
                @csrf
                Apakah Anda yakin ingin menghapus resiko <b id="nama_resiko"></b> ?
                <br>
                <input type="hidden" name="id_resiko" id="id_resiko">
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
    <script>
        const APP_URL = {!! json_encode(url('/')) !!}
    </script>
    <script type="text/javascript" src="{{asset('assets/js/custom/data_master_resiko.js')}}"></script>
@endsection
