@extends('layouts.risk-officer.table')
@section('title', 'Sumber Risiko')

@section('breadcrumb-title')
<h3>Sumber Risiko</h3>
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
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahSumberRisiko"><i class="fa fa-plus"></i> Tambah Sumber Risiko</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="basic-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Konteks</th>
                            <th>Risiko</th>
                            <th>Tahun</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>

                @foreach($sumber_risiko as $s)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td><b>{{ $s->id_risk }} - {{ $s->risk }}</b> ({{ $s->konteks }})</td>
                        <td>{{ $s->s_risiko }}</td>
                        <td>{{ $s->tahun}}</td>
                        <td>{{ $s->catatan }}</td>
                        <td>
                        @if( $s->status_s_risiko == 0)
                            <span class="badge badge-warning"><i class="fa fa-warning"></i> Belum Disetujui</span>
                        @elseif($s->status_s_risiko == 1)
                            <span class="badge badge-success"><i class="fa fa-check"></i> Disetujui</span>
                        @elseif($s->status_s_risiko == 2)
                            <span class="badge badge-danger"><i class="fa fa-times"></i> Tidak Disetujui</span>
                        @endif
                        </td>
                        <td>
                        <div class="flex" style="justify-content: center;">
                            <button class="btn btn-warning btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#edit_{{ $s->id_s_risiko }}"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#delete_{{ $s->id_s_risiko }}"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="tambahSumberRisiko" tabindex="-1" role="dialog" aria-labelledby="tambahSumberRisiko" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Input Sumber Risiko</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{route('risk-officer.sumber-risiko.store')}}">
                @csrf 
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Tahun <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <select class="form-control" name="tahun">
                        <?php
                            $tahun = "2019";
                            $bts_tahun = date("Y") + 4;
                            for ($i=$tahun; $i <= $bts_tahun ; $i++) { 
                            echo "<option value=".$i.">".$i."</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Risiko <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="s_risiko" required="required" class="form-control ">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12">Select</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select id="select-formtambah" class="js-example-basic-single col-sm-12" name="id_konteks" >
                            @foreach($risiko as $r)
                            <option value="{{ $r->id_konteks }}">{{ $r->id_risk }} - {{ $r->risk }} ({{ $r->konteks }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
            
@foreach($sumber_risiko as $s)
    <div class="modal fade" id="edit_{{ $s->id_s_risiko }}" tabindex="-1" role="dialog" aria-labelledby="editSumberRisiko" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Sumber Risiko</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{route('risk-officer.sumber-risiko.update', $s->id_s_risiko) }}">
                    @method('PUT')
                    @csrf    
                    <div class="row mb-3">
                        <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Risiko <span class="required"></span></label>
                        <div class='col-md-9 col-sm-9 col-xs-12'>
                            <input type="text" name="s_risiko" required="required" value="{{ $s->s_risiko }}" class="form-control ">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 col-sm-3 col-xs-12">Select</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="id_konteks">
                                @foreach($risiko as $r)
                                <option value="{{ $r->id_konteks }}" @if($s->id_konteks == $r->id_konteks) selected @endif>
                                    {{ $r->id_risk }} - {{ $r->risk }} ({{ $r->konteks }})
                                </option>
                                @endforeach
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

    <div class="modal fade" id="delete_{{ $s->id_s_risiko }}" tabindex="-1" role="dialog" aria-labelledby="deleteSumberRisiko" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Hapus Sumber Risiko</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{route('risk-officer.sumber-risiko.destroy', $s->id_s_risiko) }}">
                    @method('DELETE')
                    @csrf    
                    <!-- <div> -->
                    Apakah Anda yakin ingin menghapus data Sumber Risiko <b>{{ $s->s_risiko}}</b> ?
                    <br>
                    <div class="text-red">Data yang dihapus tidak dapat dikembalikan.</div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Ya, hapus!</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endforeach
@endsection

@section('script')
<script type="text/javascript">
    $('#select-formtambah').select2({
        dropdownParent: $('#tambahSumberRisiko')
    });
</script>
@endsection
