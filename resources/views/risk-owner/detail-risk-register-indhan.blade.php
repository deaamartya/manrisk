@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
@endsection

@section('page-title')
<h3>Detail Risk Register INDHAN</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Detail Risk Register INDHAN</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="product-page-details">
              <h3>ID HEADER # {{ $headers->id_riskh }}</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
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
                <div class="col-md-12 mb-2">{!! nl2br($headers->target) !!}</div>
                <h6>Lampiran :</h6>
                @if($headers->lampiran == null || $headers->lampiran == '')
                  <button class="btn btn-danger" data-bs-target="#insert-lampiran" data-bs-toggle="modal">Kosong</button>
                @else
                  <a href="{{ asset('document/lampiran/'. $headers->lampiran) }}" class="btn btn-sm btn-danger" target="_blank">
                    <span class="flex-center">
                      <i data-feather="download" class="me-2"></i>{{ $headers->lampiran }}
                    </span>
                  </a>
                @endif
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
          <div class="card-header">
            <button type="button" class="btn btn-warning" data-bs-target="#import" data-bs-toggle="modal">Import</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="table-risiko">
                <thead>
                  <tr>
                    <th>Id Risk</th>
                    <th>Korporasi</th>
                    <th>Konteks Organisasi</th>
                    <th>Risiko</th>
                    <th>Penyebab</th>
                    <th>L</th>
                    <th>C</th>
                    <th>R</th>
                    <th>Status</th>
                    <!-- <th>Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                @if($detail_risk != null )
                  @foreach($detail_risk as $d)
                  <tr>
                    <td>{{ $d->id_risk .'-'. $d->no_k }}</td>
                    <td>{{ $d->instansi }}</td>
                    <td>{{ $d->konteks }}</td>
                    <td>{{ $d->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ number_format($d->l_awal, 2) + 0 }}</td>
                    <td>{{ number_format($d->c_awal, 2) + 0 }}</td>
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
                      {{ number_format($d->r_awal, 2) + 0 }}
                      </span>
                    </td>
                    <td>
                      {{-- @if($mitigasi === 1)
                      <span>Aksi Mitigasi telah diajukan</span>
                      @else --}}
                        @if($d->r_awal >= 12)
                          <!-- <button class="btn btn-sm btn-pill btn-success" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Tidak Perlu Mitigasi
                          </button> -->
                          <span class="badge badge-primary">Ajukan Mitigasi</span>
                        @elseif($d->r_awal < 12)
                          <!-- <button class="btn btn-sm btn-pill btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Ajukan Mitigasi
                          </button> -->
                          <span class="badge badge-success">Aman</span>
                        @endif
                      {{-- @endif --}}
                    </td>
                    <!-- <td>
                      <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#edit-risk-{{ $d->id_riskd }}">
                        <i data-feather="edit-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#delete-risk-{{ $d->id_riskd }}">
                        <i data-feather="trash-2" class="small-icon"></i>
                      </button>
                    </td> -->
                  </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="insert-lampiran" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Input Lampiran Risiko</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('risk-owner.upload-lampiran-risk-register-indhan') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $headers->id_riskh }}">
          <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Lampiran</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" name="lampiran" required>
                        </div>
                    </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Risk Detail</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('risk-owner.risk-detail.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id_header" value="{{ $headers->id_riskh }}">
          <input type="file" name="file" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-link" type="button" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-success" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/summernote/summernote.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
    $("#table-risiko").DataTable({
      'order': [ 7, 'desc' ]
    });
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
