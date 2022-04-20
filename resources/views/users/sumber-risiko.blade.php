@extends('layouts.user.table')
@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Sumber Risiko</h5>
          </div>
          <div class="card-body">
            <button class="btn btn-primary mb-4" type="button" data-bs-toggle="modal" data-bs-target="#tambahSumberRisiko"><i class="fa fa-plus"></i>Tambah Sumber Risiko</button>
            <div class="modal fade" id="tambahSumberRisiko" tabindex="-1" role="dialog" aria-labelledby="tambahSumberRisiko" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Input Sumber Risiko</h5>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" enctype="multipart/form-data" action="{{route('user.sumber-risiko.store')}}">
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
                            <select class="form-control" name="id_konteks">
                                @foreach($risiko as $r)
                                <option value="<?php echo $r->id_konteks ?>">{{ $r->id_risk }} - {{ $r->risk }} ({{ $r->konteks }})</option>
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
                        <td>{{ $s->konteks }}</td>
                        <td>{{ $s->s_risiko }}</td>
                        <td>{{ $s->tahun}}</td>
                        <td>{{ $s->catatan }}</td>
                        <td>
                          @if( $s->status_s_risiko == 0)
                            <span class="badge badge-warning">Belum Disetujui</span>
                          @elseif($s->status_s_risiko == 1)
                            <span class="badge badge-success">Disetujui</span>
                          @elseif($s->status_s_risiko == 2)
                            <span class="badge badge-danger">Tidak Disetujui</span>
                          @endif
                        </td>
                        <td>
                        <div class="flex" style="justify-content: center;">
                            <a data-toggle="modal" data-target="#edit_{{ $s->id_s_risiko }}">
                                <button href="javascript:;" title="Edit Sumber Risiko" type="button" class="btn btn-warning btn-xs">
                                    <span class=" flex items-center justify-center">
                                        <i data-feather="edit"></i>
                                    </span>
                                </button>
                            </a>
                            <a data-toggle="modal" data-target="#delete_{{$s->id_s_risiko}}">
                                <button href="javascript:;" title="Hapus Sumber Risiko" type="button" class="btn btn-danger btn-xs">
                                    <span class="flex items-center justify-center">
                                        <i data-feather="trash-2"></i>
                                    </span>
                                </button>
                            </a>
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
</div>
@endsection