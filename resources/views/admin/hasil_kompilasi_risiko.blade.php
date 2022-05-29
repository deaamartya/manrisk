@extends('layouts.user.table')
@section('title', 'Hasil Kompilasi Risiko')
{{-- @section('style')
    <style>
        .js-example-basic-single {
            display: none;
        }
    </style>
@endsection --}}

@section('breadcrumb-title')
<h3>Hasil Kompilasi Risiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Hasil Kompilasi Risiko</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row" id="aksi-filter">
                            <div class="col-sm-4">
                                {{-- <label class="col-md-3 col-sm-3 col-xs-12">Divisi</label> --}}
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="js-example-basic-single" name="company_id" id="formPerusahaan">
                                        <option selected disabled>Pilih Perusahaan..</option>
                                        @foreach($companies as $c)
                                            <option value="{{ $c->company_id }}">{{ $c->company_code }} - {{ $c->instansi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <input type="text" name="tahun" class="form-control" id="formTahun" placeholder="Tahun">
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="cari">Cari</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-success print"><i class="fa fa-print"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Responden Kuisioner</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="responden_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Penilaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sumber Risiko</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="sumber_risiko_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Perusahaan</th>
                                    <th>Konteks</th>
                                    <th>Risiko</th>
                                    <th>Tahun</th>
                                    <th>L Awal</th>
                                    <th>C Awal</th>
                                    <th>R Awal</th>
                                    <th>Status</th>
                                    <th>Status Indhan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteResponden" tabindex="-1" role="dialog" aria-labelledby="modalDeleteResponden">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Delete Responden</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="" id="form-delete-responden">
                @csrf
                Apakah Anda yakin ingin menghapus responden <b id="nama-responden"></b> ?
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
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
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript" src="{{asset('assets/js/custom/hasil_kompilasi_risiko.js')}}"></script>
@endsection
