@extends('layouts.user.table')
@section('title', 'Penilaian Risiko')

@section('breadcrumb-title')
<h3>Penilaian Risiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Pengukuran Risiko</li>
<li class="breadcrumb-item active">Penilaian Risiko</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <table style="border:none;">
                        <tr>
                            <td><b>Nama Responden </b></td>
                            <td>:</td>
                            <td>{{ $nama_responden }}</td>
                        </tr>
                        <tr>
                            <td><b>Tahun</b></td>
                            <td>:</td>
                            <td>{{ $tahun }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <form action="{{route('risk-officer.penilaian-risiko-store')}}" method="POST">
                        @csrf 
                        <input type="hidden" name="tahun" value="{{ $tahun }}" required style="display: none;">
                        <input type="hidden" name="id_responden" value="{{ $id_responden }}" required style="display: none;">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Konteks</th>
                                    <th>Risiko</th>
                                    <th>Nilai L (1-5)</th>
                                    <th>Nilai C (1-5)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($sumber_risiko as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><b>{{ $s->risk }}</b> ({{ $s->konteks }})</td>
                                    <td>{{ $s->s_risiko }}</td>
                                    <!-- <td><input type="number" name="nilai_L[]" required></td>
                                    <td><input type="number" name="nilai_C[]" required></td> -->
                                    <td>
                                        <select class="js-example-basic-single col-sm-12" name="nilai_L[]" required>
                                            <option selected disabled>Pilih Nilai L</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="js-example-basic-single col-sm-12" name="nilai_C[]" required>
                                            <option selected disabled>Pilih Nilai C</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                    <input type="hidden" name="id_s_risk[]" required value=" {{ $s->id_s_risiko }}" style="display: none;"> 
                                    <input type="hidden" name="nama_responden" value="{{ $nama_responden }}" required style="display: none;">
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button class="btn btn-primary mt-4" type="submit" style="float:right;">Simpan Penilaian</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
