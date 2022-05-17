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
                                    <tr>
                                        <th>No</th>
                                        <th>Responden</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>Manrisk Tahun</th>
                                        <th>Jumlah Dinilai</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            <tbody>
                            @php
                                $no = 1;
                            @endphp
                                @if(count($pengukuran) > 0)
                                    @foreach($pengukuran as $p)
                                        <tr>
                                            <td class="text-center">{{ $no++; }}</td>
                                            <td>{{ $p->nama_responden }}</td>
                                            <td>{{ date_format( $p->tgl_penilaian,"d/m/Y H:i:s") }}</td>
                                            <td>{{ $p->tahun}}</td>
                                            <td class="text-center">{{ $jml_risk }}</td>
                                            <td class="text-center"><span class="badge badge-success">Sudah Dinilai</span></td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(count($arr_pengukur) > 0)
                                    @foreach($arr_pengukur as $p)
                                        <tr>
                                            <td class="text-center">{{ $no++; }}</td>
                                            <td>{{ $p->jabatan }}</td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">{{ $jml_risk }}</td>
                                            <td class="text-center">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#insert_responden{{ $no; }}" class="btn btn-danger btn-sm"> Mulai Penilaian</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="insert_responden{{ $no; }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title">Input Data Responden</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="POST" action="{{route('penilai-indhan.penilaian-risiko-indhan') }}">
                                                        @csrf    
                                                        <div class="row mb-3">
                                                            <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Nama Responden <span class="required"></span></label>
                                                            <div class='col-md-9 col-sm-9 col-xs-12'>
                                                            <input type="text" name="nama_responden" style="width: 100%;" required="required" class="form-control " readonly value="{{ $p->jabatan}}">
                                                            <input type="hidden" name="id_responden" required="required" value="{{ $p->id_pengukur }}">
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


<div class="modal fade" id="daftarKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="daftarKlasifikasi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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