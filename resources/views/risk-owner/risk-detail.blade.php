@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
@endsection

@section('page-title')
<h3>Risk Register Korporasi</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Risk Register Korporasi</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="product-page-details">
              <h3>ID HEADER # {{ $headers->id_riskh }}</h3>
            </div>
            <a href="{{ route('risk-owner.risiko.index') }}">
              <button class="btn btn-sm btn-success">
                Kembali
              </button>
            </a>
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
                <div class="col-md-5 mb-2">
                  <h6>Lampiran</h6>
                  <hr class="hr-custom">
                </div>
                <div class="col-md-12 mb-3">
                  @if($headers->lampiran == null || $headers->lampiran == '')
                    <button class="btn btn-danger mb-3" data-bs-target="#insert-lampiran" data-bs-toggle="modal">Kosong</button>
                  @else
                    <a href="{{ asset('document/lampiran/'. $headers->lampiran) }}" class="btn btn-sm btn-danger mb-3">
                      <span class="flex-center">
                        <i data-feather="download" class="me-2"></i>{{ $headers->lampiran }}
                      </span>
                    </a>
                  @endif
                </div>
                <div class="col-md-5"><h6>Status</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">
                  @if($headers->status_h == 0)
                  <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval Risk Owner</span>
                  @elseif($headers->status_h == 1)
                  <span class="badge badge-success"><i class="fa fa-check"></i> Approved Risk Owner</span>
                  @endif
                  @if($headers->status_h_indhan == 0)
                  <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval Admin</span>
                  @elseif($headers->status_h_indhan == 1)
                  <span class="badge badge-success"><i class="fa fa-check"></i> Approved Admin</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            Kelompok Risiko
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <span class="badge badge-blue me-2"> </span>Rendah
              </div>
              <div class="col">
                <span class="badge badge-green me-2"> </span>Rendah-Menengah
              </div>
              <div class="col">
                <span class="badge badge-warning me-2"> </span>Menengah
              </div>
              <div class="col">
                <span class="badge badge-orange me-2"> </span>Menengah-Tinggi
              </div>
              <div class="col">
                <span class="badge badge-danger me-2"> </span>Tinggi
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
                    <th>Konteks Organisasi</th>
                    <th>Risiko</th>
                    <th>Penyebab</th>
                    <th>L</th>
                    <th>C</th>
                    <th>R</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($headers->risk_detail as $d)
                  <tr>
                    <td>{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k }}</td>
                    <td>{{ $d->sumber_risiko->konteks->konteks }}</td>
                    <td>{{ $d->sumber_risiko->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ number_format($d->l_awal, 2) }}</td>
                    <td>{{ number_format($d->c_awal, 2) }}</td>
                    <td>
                      @if($d->r_awal < 6)
                      <span class="badge badge-blue me-2">
                      @elseif($d->r_awal < 12)
                      <span class="badge badge-green me-2">
                      @elseif($d->r_awal < 16)
                      <span class="badge badge-warning me-2">
                      @elseif($d->r_awal < 20)
                      <span class="badge badge-orange me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($d->r_awal ,2) }}
                      </span>
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
@if (count($data->pengajuan_mitigasi) === 0)
<div class="modal fade" id="pengajuan-mitigasi-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          @if ($data->r_awal >= 12)
          <h5 class="modal-title">Ajukan Tidak Perlu Mitigasi</h5>
          @elseif ($data->r_awal < 12)
          <h5 class="modal-title">Ajukan Mitigasi</h5>
          @endif
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('risk-officer.pengajuan-mitigasi.store') }}" method="POST">
          @csrf
          <input type="hidden" value="{{ $data->id_riskd }}" name="id_risk_detail">
          @if ($data->r_awal >= 12)
          <input type="hidden" value="0" name="tipe_pengajuan">
          @elseif ($data->r_awal < 12)
          <input type="hidden" value="1" name="tipe_pengajuan">
          @endif
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Alasan</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="alasan" required></textarea>
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
@endif
<div class="modal fade" id="delete-risk-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('risk-officer.risk-detail.destroy', $data->id_riskd) }}" method="POST">
          @method('DELETE')
          @csrf
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus risk detail dengan risiko {{ $data->sumber_risiko->s_risiko }}?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-link" type="button" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-success" type="submit">Hapus</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/summernote/summernote.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
  })
  function cal() {
    var lawal = $('#l_awal').val();
    var cawal = $('#c_awal').val();
    var mul = lawal * cawal;
    $('#r_awal').val(mul);
  }
  function calEdit(id) {
    var lawal = $('#l_awal_'+id).val();
    var cawal = $('#c_awal_'+id).val();
    var mul = lawal * cawal;
    $('#r_awal_'+id).val(mul);
  }
</script>
@endsection