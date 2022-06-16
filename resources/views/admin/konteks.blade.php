@extends('layouts.user.table')
@section('title', 'Data Master | Konteks')

@section('breadcrumb-title')
<h3>Konteks</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Konteks</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" type="button" id="tambah_konteks"><i class="fa fa-plus"></i> Tambah Konteks</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Risk</th>
                                    <th>Risk</th>
                                    <th>Tahun</th>
                                    <th>Konteks</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($konteks as $k)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $k->id_risk }}</td>
                                    <td>{{ $k->risk }}</td>
                                    <td>{{ $k->tahun_konteks }}</td>
                                    <td>{{ $k->konteks }}</td>
                                    <td>
                                        <div class="text-center">
                                            <button class="btn btn-warning btn-xs edit" type="button" id="edit_{{ $k->id_konteks }}"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-primary btn-xs delete" type="button" id="delete_{{ $k->id_konteks }}"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="tambahKonteks" role="dialog" aria-labelledby="tambahKonteks" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="judul_modal"></h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="" id="formKonteks">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">No <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="no_k" required="required" class="form-control" id="formNo">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12">ID Resiko</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="js-example-basic-single col-sm-12" name="id_risk" id="formIdRisk"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Tahun <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="tahun_konteks" required="required" class="form-control" id="formTahunKonteks">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Konteks <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        {{-- <input type="text" name="konteks" required="required" class="form-control" id="formKonteks"> --}}
                        <textarea name="konteks" class="form-control" id="formIsiKonteks" rows="2"></textarea>
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

<div class="modal fade" id="deleteKonteks" tabindex="-1" role="dialog" aria-labelledby="deleteKonteks" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Hapus Konteks</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('admin.konteks-delete') }}">
                @csrf
                Apakah Anda yakin ingin menghapus konteks <b id="nama_konteks"></b> ?
                <br>
                <input type="hidden" name="id_konteks" id="id_konteks">
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
    <script type="text/javascript" src="{{asset('assets/js/custom/data_master_konteks.js')}}"></script>
@endsection
