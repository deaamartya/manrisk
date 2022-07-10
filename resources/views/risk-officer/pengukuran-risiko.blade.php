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
                            {{--
                            @if(count($arr_pengukuran) > 0)
                                @foreach($arr_pengukuran as $p)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_responden }}</td>
                                        <td>{{ date_format( $p->tgl_penilaian,"d/m/Y H:i:s") }}</td>
                                        <td >{{ $p->tahun}}</td>
                                        <td class="text-center">{{ $jml_risk }}</td>
                                        <td class="text-center"><span class="badge badge-success">Sudah Dinilai</span></td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(count($arr_pengukur) > 0)
                                @foreach($arr_pengukur as $key=>$val)
                                    <tr>
                                        <td class="text-center">{{ count($arr_pengukuran) + $loop->iteration }}</td>
                                        <td>{{ $arr_pengukur[$key] }}</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">{{ $jml_risk_pengukur }}</td>
                                        <td class="text-center">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#insert_responden{{ count($arr_pengukuran) + $loop->iteration }}" class="btn btn-danger btn-sm"> Mulai Penilaian</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="insert_responden{{ count($arr_pengukuran) + $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Input Data Responden</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{route('risk-officer.penilaian-risiko') }}">
                                                    @csrf    
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Nama Responden <span class="required"></span></label>
                                                        <div class='col-md-9 col-sm-9 col-xs-12'>
                                                        <input type="text" name="nama_responden" style="width: 100%;" required="required" class="form-control " readonly value="">
                                                        <input type="hidden" name="id_responden" required="required" value="">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-sm-3 col-xs-12">Penilaian Tahun</label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <?php
                                                            $l_tahun = array();
                                                            $today = date("Y");
                                                            $today_plus = date('Y', strtotime('+1 years'));
                                                            array_push($l_tahun, $today);
                                                            array_push($l_tahun, $today_plus);
                                                            ?>
                                                            <select class="form-control pull-left" name="tahun">
                                                            <?php
                                                            for ($j=0; $j < sizeof($l_tahun); $j++) {  ?>
                                                                <option value=" {{ $l_tahun[$j]  }}"> 
                                                                    {{ $l_tahun[$j] }} </option>  
                                                            <?php }
                                                            ?>
                                                            </select>
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
                            --}}


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

                                    {{--
                                    <div class="modal fade" id="insert_responden{{ count($pengukuran_1) + $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Input Data Responden</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{route('risk-officer.penilaian-risiko') }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Nama Responden <span class="required"></span></label>
                                                        <div class='col-md-9 col-sm-9 col-xs-12'>
                                                        <input type="text" name="nama_responden" style="width: 100%;" required="required" class="form-control " readonly value="{{ Auth::user()->defendid_pengukur->jabatan }}">
                                                        <input type="hidden" name="id_responden" required="required" value="{{ Auth::user()->defendid_pengukur->id_pengukur }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-sm-3 col-xs-12">Penilaian Tahun</label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <?php
                                                            $l_tahun = array();
                                                            $today = date("Y");
                                                            $today_plus = date('Y', strtotime('+1 years'));
                                                            array_push($l_tahun, $today);
                                                            array_push($l_tahun, $today_plus);
                                                            ?>
                                                            <select class="form-control pull-left" name="tahun">
                                                            <?php
                                                            for ($j=0; $j < sizeof($l_tahun); $j++) {  ?>
                                                                <option value=" {{ $l_tahun[$j]  }}">
                                                                    {{ $l_tahun[$j] }} </option>
                                                            <?php }
                                                            ?>
                                                            </select>
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
                                    --}}
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
                    </tr>
                @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
            @else
            <div class="alert alert-danger">Sumber risiko untuk perusahaan ini pada tahun {{ date('Y') }} belum tersedia.</div>
            @endif
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