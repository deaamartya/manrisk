@extends('layouts.user.table')
@section('title', 'Sumber Risiko')

@section('breadcrumb-title')
<h3>Pengukuran Risiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Pengukuran Risiko</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
    @if($sr_exists)
        @if(Auth::user()->defendid_pengukur)
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
                                            <form method="POST" action="{{route('risk-officer.penilaian-risiko') }}">
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
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#daftarKlasifikasi">Daftar Klasifikasi</button>                                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{route('risk-officer.pengukuran-generatePDF') }}" class="btn btn-success" target="_blank">
                                <i class="fa fa-print"></i> Cetak Penilaian
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <center>
                <h5>Sumber Risiko</h5>
                <h6 style="color:#3C88F7">{{  Auth::user()->perusahaan->instansi }}</h6>
            </center>
            <br>
            <div class="table-responsive">
                <table class="display" id="basic-2">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>PIC</th>
                            <th>Konteks</th>
                            <th>Risiko</th>
                            <th>Tahun</th>
                            <th>L Awal</th>
                            <th>C Awal</th>
                            <th>R Awal</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                <tbody>
                @foreach($sumber_risiko as $s)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->konteks }}</td>
                        <td>{{ $s->s_risiko }}</td>
                        <td class="text-center">{{ $s->tahun}}</td>
                        <td class="text-center">{{ round($s->nilai_L, 2) }}</td>
                        <td class="text-center">{{ round($s->nilai_C, 2) }}</td>
                        <td class="text-center">
                        {{ number_format(($s->nilai_L * $s->nilai_C),2) + 0 }}
                        </td>
                        <td class="text-center">
                            @if($s->status_s_risiko == 0)
                                <a role="button"><span class="badge rounded-pill badge-warning" title="Belum Disetujui"><i class="fa fa-question"></i></span></a>
                            @elseif($s->status_s_risiko == 1)
                                <a role="button"><span class="badge rounded-pill badge-success" title="Disetujui"><i class="fa fa-check"></i></span></a>
                            @elseif($s->status_s_risiko == 2)
                                <a role="button"><span class="badge rounded-pill badge-danger" title="Tidak Disetujui"><i class="fa fa-close"></i></span></a>
                            @endif
                        </td>
                        <td>
                            @if ($s->id_user == Auth::user()->id_user)
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete-{{ $s->id_p }}" class="btn btn-danger btn-sm">Hapus Penilaian</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
            @else
            <div class="alert alert-danger">Maaf Anda belum memiliki akses sebagai penilai untuk pengukuran. Silahkan hubungi risk officer / admin untuk mengatur ulang hak akses Anda.</div>
            @endif
        @else
        <div class="alert alert-danger">Sumber risiko untuk perusahaan ini belum tersedia. Silahkan menambahkan sumber risiko terlebih dahulu.</div>
        @endif
        </div>
    </div>
</div> 


<div class="modal fade bd-example-modal-lg" id="daftarKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="daftarKlasifikasi" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
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
@foreach($sumber_risiko as $s)
<div class="modal fade" id="delete-{{ $s->id_p }}" tabindex="-1" role="dialog" aria-labelledby="daftarKlasifikasi" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Hapus Pengukuran</h6>
            </div>
            <form method="POST" action="{{ route('risk-officer.pengukuran-risiko.destroy', $s->id_p) }}">
                @method('DELETE')
                <div class="modal-body">
                    @csrf
                    Apakah Anda yakin ingin menghapus pengukuran #{{ $s->id_p }} untuk Sumber Risiko <strong>{{ $s->s_risiko }}</strong> tahun <strong>{{ $s->tahun}}</strong> dengan nilai L: <strong>{{ round($s->nilai_L, 2) }}</strong>, nilai C: <strong>{{ round($s->nilai_C, 2) }}</strong>, nilai R: <strong>{{ number_format(($s->nilai_L * $s->nilai_C),2) + 0 }}</strong> ?
                    <br>
                    Data yang sudah dihapus tidak dapat dikembalikan.
                    <input type="hidden" name="id_p" id="id_pengukuran" value="{{ $s->id_p }}">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Tidak</button>
                    <button class="btn btn-primary" type="submit">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection