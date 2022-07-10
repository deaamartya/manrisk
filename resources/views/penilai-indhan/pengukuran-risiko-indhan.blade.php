@extends('layouts.user.table')
@section('title', 'Sumber Risiko')

@section('breadcrumb-title')
<h3>Pengukuran Risiko INDHAN</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Pengukuran Risiko INDHAN</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Responden</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>Manrisk Tahun</th>
                                        <th>Jumlah Dinilai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @if(count($pengukuran_1) > 0)
                                    @foreach($pengukuran_1 as $p)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama_responden }}</td>
                                            <td>{{ date( "d/m/Y H:i:s", strtotime($p->tgl_penilaian)) }}</td>
                                            <td class="text-center">{{ $p->tahun}}</td>
                                            <td class="text-center">{{ $p->jml_risk }}</td>
                                            <td class="text-center"><span class="badge badge-success">Sudah Dinilai</span></td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(count($pengukuran_2) > 0)
                                    @foreach($pengukuran_2 as $p)
                                        <tr>
                                            <td class="text-center">{{ count($pengukuran_1) + $loop->iteration }}</td>
                                            <td>{{ $p->jabatan }}</td>
                                            <td></td>
                                            <td class="text-center">{{ $p->tahun}}</td>
                                            <td class="text-center">{{ $p->jml_risk}}</td>
                                            <td class="text-center">
                                                @if ($p->id_pengukur === Auth::user()->defendid_pengukur->id_pengukur)
                                                <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#insert_responden{{ count($pengukuran_1) + $loop->iteration }}" class="btn btn-danger btn-sm"> Mulai Penilaian</button> -->
                                                <form method="POST" action="{{route('penilai-indhan.penilaian-risiko-indhan') }}">
                                                @csrf
                                                    <input type="hidden" name="nama_responden" value="{{ Auth::user()->defendid_pengukur->jabatan }}">
                                                    <input type="hidden" name="id_responden" value="{{ Auth::user()->defendid_pengukur->id_pengukur }}">
                                                    <input type="hidden" name="tahun" value="{{ $p->tahun }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"> Mulai Penilaian</button>
                                                </form>
                                                @else
                                                <span class="badge badge-danger">Belum Dinilai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-secondary mb-2" type="button" data-bs-toggle="modal" data-bs-target="#daftarKlasifikasi">Daftar Klasifikasi</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div> 


<div class="modal fade bd-example-modal-lg" id="daftarKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="daftarKlasifikasi" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h6 class="modal-title">Daftar Klasifikasi Kriteria Kemungkinan dan Dampak</h6>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed src="{{asset('/uploads/Daftar Klasifikasi Kriteria kemungkinan dan dampak.pdf')}} " width="100%" height="700px"></embed>
            </div>
        </div>
    </div>
</div>


            
@endsection