@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('page-title')
<h3>Detail Mitigasi Plan</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Detail Mitigasi Plan</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5>ID HEADER # {{ $headers->id_riskh }}</h5>
              <a href="{{ route('risk-officer.risiko.print', $headers->id_riskh) }}" class="btn btn-sm btn-success">
                <span class="flex-center">
                  <i data-feather="printer" class="me-2"></i>Cetak
                </span>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-4"><h6>Instansi</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->perusahaan->instansi }}</div>
                <div class="col-md-4"><h6>Tahun Risiko</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->tahun }}</div>
                <div class="col-md-4"><h6>Tanggal Dibuat</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ date('d M Y', strtotime($headers->tanggal)) }}</div>
                <div class="col-md-3"><h6>Penyusun</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->penyusun }}</div>
                <div class="col-md-3"><h6>Pemeriksa</h6><hr class="hr-custom"></div>
                <div class="col-md-12">{{ $headers->pemeriksa }}</div>
              </div>
              <div class="col-md-6">
                <div class="col-md-5"><h6>Sasaran / Target</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-3">{!! $headers->target !!}</div>
                @if($headers->lampiran != null || $headers->lampiran != '')
                <div class="col-md-5 mb-2">
                  <h6>Lampiran</h6>
                  <hr class="hr-custom">
                </div>
                <div class="col-md-12 mb-3">
                  <a href="{{ asset('document/lampiran/'. $headers->lampiran) }}" class="btn btn-sm btn-danger mb-3">
                    <span class="flex-center">
                      <i data-feather="download" class="me-2"></i>{{ $headers->lampiran }}
                    </span>
                  </a>
                </div>
                @endif
                <div class="col-md-5"><h6>Status</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">
                  @if($headers->status_h == 0)
                  <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval Risk Owner</span>
                  @elseif($headers->status_h == 1)
                  <span class="badge badge-success"><i class="fa fa-check"></i> Approved Risk Owner</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>Id Risk</th>
                    <th>Risiko</th>
                    <th>Level Risiko Awal</th>
                    <th>Level Risiko Akhir</th>
                    <th>Mitigasi</th>
                    <th>Jadwal Pelaksanaan</th>
                    <th>% Realisasi</th>
                    <th>Keterangan</th>
                    <th>Dokumen</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($headers->getMitigasiDetail() as $d)
                  <tr>
                    <td>{{ $d->id_risk .'-'. $d->no_k }}</td>
                    <td>{{ $d->s_risiko }}</td>
                    <td>{{ $d->l_awal }}</td>
                    <td>{{ $d->l_akhir }}</td>
                    <td>
                      @if($d->mitigasi === null) -
                      @else {{ $d->mitigasi }}
                      @endif
                    </td>
                    <td>
                      @if($d->jadwal_mitigasi === null) -
                      @else {{ date('d M Y', strtotime($d->jadwal_mitigasi)) }}
                      @endif
                    </td>
                    <td>
                      @if($d->realisasi === null) -
                      @else {{ $d->realisasi }}%
                      @endif
                    </td>
                    <td>{{ $d->keterangan }}</td>
                    <td>
                      @if($d->u_file)
                      <button class="btn btn-xs btn-primary p-1 flex-center" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#preview-document-{{ $d->id_riskd }}">
                        <i data-feather="zoom-in" class="small-icon" height="13"></i>View File
                      </button>
                      @endif
                    </td>
                    <td>
                      @if(auth()->user()->is_admin == 1)
                        <a href="{{ url('admin/approval-mitigasi/'.$d->id_riskd) }}"><button class="btn btn-xs btn-info p-1 flex-center">
                          <i data-feather="edit" class="small-icon" height="13"></i>
                        </button></a>
                      @else
                        <button class="btn btn-xs btn-info p-1 flex-center" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#edit-mitigasi-{{ $d->id_riskd }}">
                          <i data-feather="edit" class="small-icon" height="13"></i>
                        </button>
                      @endif
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
@foreach($headers->risk_detail as $data)
<div class="modal fade" id="edit-mitigasi-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Input Data Mitigasi</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('risk-officer.mitigasi-plan.update', $data->id_riskd) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">ID Risk</label>
									<div class="col-sm-9">
                    <input class="form-control" name="id_riskd" required readonly value="{{ $data->id_riskd }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Level Risiko Awal</label>
									<div class="col-sm-9">
                    <input class="form-control" name="r_awal" required readonly value="{{ $data->r_awal }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Risiko</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="risiko" required readonly>{{ $data->sumber_risiko->s_risiko }}</textarea>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Mitigasi</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="mitigasi" required>{{ $data->mitigasi }}</textarea>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Jadwal Pelaksanaan</label>
									<div class="col-sm-9">
                    <div class="date-picker">
                      <input class="datepicker-here form-control digits" type="text" data-language="en" name="jadwal_mitigasi" value="{{ date('Y-m-d', strtotime($data->jadwal_mitigasi)) }}">
                    </div>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Keterangan</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="keterangan" required>{{ $data->keterangan }}</textarea>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">L</label>
									<div class="col-sm-9">
                    <input type="number" class="form-control" onkeyup="cal({{ $data->id_riskd }})" id="l_akhir_{{ $data->id_riskd }}" name="l_akhir" required value="{{ $data->l_akhir }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">C</label>
									<div class="col-sm-9">
                    <input type="number" class="form-control" onkeyup="cal({{ $data->id_riskd }})" id="c_akhir_{{ $data->id_riskd }}" name="c_akhir" required value="{{ $data->c_akhir }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">R</label>
									<div class="col-sm-9">
                    <input type="number" class="form-control" onkeyup="cal({{ $data->id_riskd }})" id="r_akhir_{{ $data->id_riskd }}" name="r_akhir" required value="{{ $data->r_akhir }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Upload File</label>
									<div class="col-sm-9">
                    <input type="file" class="form-control" name="u_file">
									</div>
								</div>
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
<div class="modal fade" id="preview-document-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Preview Document</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <embed src="{{ asset('document/lampiran-mitigasi/'.$data->u_file) }}" width="100%" height="500"/>
        </div>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/summernote/summernote.min.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
  })
  function cal(id) {
    var lawal = $('#l_akhir_'+id).val();
    var cawal = $('#c_akhir_'+id).val();
    var mul = lawal * cawal;
    $('#r_akhir_'+id).val(mul);
  }
</script>
@endsection
