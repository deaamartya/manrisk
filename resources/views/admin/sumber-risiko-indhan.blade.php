@extends('layouts.user.table')
@section('title', 'Sumber Risiko INDHAN')

@section('breadcrumb-title')
<h3>Lihat Sumber Risiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Sumber Risiko</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
        <div class="card">
        <div class="card-header">
            <form method="POST" action="{{route('admin.search-risiko') }}">
                @csrf
                <div class="row">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Pilih Perusahaan<span class="required"></span></label>
                    <div class="col-md-5 col-sm-5 col-xs-12 select2-normal">
                        <select class="js-example-basic-single col-sm-12" name="id_user" >
                            @foreach($perusahaan as $p)
                            <option value="{{ $p->id_user }}"  @if($p->company_id == $perusahaan_filter) selected @endif>{{ $p->company_code }} - {{ $p->instansi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-md-2 col-sm-2 col-xs-12'>
                        <input type="number" name="tahun" placeholder="Tahun" required="required" class="form-control ">
                    </div>
                    <div class='col-md-2 col-sm-2 col-xs-12'>
                        <button class="btn btn-primary" type="submit">Lihat</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="basic-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Risiko</th>
                            <th>Konteks</th>
                            <th>Tahun</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                <tbody>
                @if($sumber_risiko != null)
                    @foreach($sumber_risiko as $s)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $s->instansi }}</td>
                            <td>{{ $s->s_risiko }}</td>
                            <td>{{ $s->konteks}}</td>
                            <td class="text-center">{{ $s->tahun}}</td>
                            <td class="text-center">
                            @if( $s->status_s_risiko == 0)
                                <button class="btn btn-warning btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#edit_{{ $s->id_s_risiko }}"><i class="fa fa-question"></i></button>
                            @elseif($s->status_s_risiko == 1)
                                <button class="btn btn-green btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#edit_{{ $s->id_s_risiko }}"><i class="fa fa-check"></i></button>
                            @elseif($s->status_s_risiko == 2)
                                <button class="btn btn-danger btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#edit_{{ $s->id_s_risiko }}"><i class="fa fa-close"></i></button>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@if($sumber_risiko != null)
    @foreach($sumber_risiko as $s)
        <div class="modal fade" id="edit_{{ $s->id_s_risiko }}" role="dialog" aria-labelledby="approvalSumberRisiko" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Verifikasi Sumber Risiko</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="{{route('admin.approval-risiko', $s->id_s_risiko) }}">
                        @csrf    
                        <div class="row mb-3">
                            <label class="col-md-3 col-sm-3 col-xs-12">Status Verifikasi</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="js-example-basic-single col-sm-12" name="status_verifikasi" required>
                                    <option value="1" @if($s->status_s_risiko == 1) selected @endif>Disetujui</option>
                                    <option value="2" @if($s->status_s_risiko == 2) selected @endif>Tidak Disetujui</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Catatan</label>
                            <div class='col-md-9 col-sm-9 col-xs-12'>
                                <textarea name="catatan" class="form-control ">{{ $s->catatan }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection
