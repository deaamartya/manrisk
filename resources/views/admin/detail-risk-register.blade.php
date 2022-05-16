@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
@endsection

@section('page-title')
<h3>Risk Register INDHAN</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Risk Register INDHAN</li>
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
              <h5>ID HEADER # {{ $headers->id_riskh }}</h5>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-4"><h6>Instansi</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->instansi }}</div>
                <div class="col-md-4"><h6>Tahun Risiko</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->tahun }}</div>
                <div class="col-md-4"><h6>Tanggal Dibuat</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ date('d M Y', strtotime($headers->tanggal)) }}</div>
                <div class="col-md-5"><h6>Sasaran / Target</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{!! $headers->target !!}</div>
              </div>
              <div class="col-md-6">
                <div class="col-md-3"><h6>Penyusun</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->penyusun }}</div>
                <div class="col-md-3"><h6>Pemeriksa</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-3">{{ $headers->pemeriksa }}</div>
                <h6>Status</h6>
                @if($headers->status_h == 1)
                <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval Risk Owner</span>
                @elseif($headers->status_h == 2)
                <span class="badge badge-success"><i class="fa fa-check"></i> Approved Risk Owner</span>
                @endif

                @if($headers->status_h_indhan == 1)
                <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval INDHAN</span>
                @elseif($headers->status_h_indhan == 2)
                <span class="badge badge-success"><i class="fa fa-check"></i> Approved INDHAN</span>
                @endif
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
                    <th>Korporasi</th>
                    <th>Mitigasi</th>                  
                    <th>Konteks Organisasi</th>
                    <th>Indikator</th>
                    <th>Risiko</th>
                    <th>Penyebab</th>
                    <th>Dampak</th>
                    <th>UC/C</th>
                    <th>Pengendalian</th>
                    <th>L Awal</th>
                    <th>C Awal</th>
                    <th>R Awal</th>
                    <th>Peluang</th>
                    <th>Tindak Lanjut</th>
                    <th>Jadwal Pelaksanaan</th>
                    <th>PIC</th>
                    <th>Dokumen Terkait</th>
                    <th>L Akhir</th>
                    <th>C Akhir</th>
                    <th>R Akhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($headers->risk_detail as $d)
                  <tr>
                    <td>{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k }}</td>
                    <td>
                      <form action="" method="POST">
                          @csrf
                          @if($d->status_korporasi == 0)
                            <button type="submit" class="btn btn-sm btn-pill btn-success d-flex align-items-center">
                              <i class="fa fa-times me-2"></i>Bukan Korporasi
                            </button>
                          @else
                            <button type="submit" class="btn btn-sm btn-pill btn-danger d-flex align-items-center">
                              <i class="fa fa-check me-2"></i> Korporasi
                            </button>
                          @endif
                      </form>
                    </td>
                    <td>
                      <form action="" method="POST">
                          @csrf
                          @if($d->status_mitigasi == 0)
                            <button type="submit" class="btn btn-sm btn-pill btn-success d-flex align-items-center">
                              <i class="fa fa-times me-2"></i> Tidak Mitigasi
                            </button>
                          @else
                            <button type="submit" class="btn btn-sm btn-pill btn-danger d-flex align-items-center">
                              <i class="fa fa-check me-2"></i> Perlu Mitigasi
                            </button>
                          @endif
                      </form>
                    </td>
                    <td>{{ $d->sumber_risiko->konteks->konteks }}</td>
                    <td>{{ $d->indikator }}</td>
                    <td>{{ $d->sumber_risiko->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ $d->dampak }}</td>
                    <td>{{ $d->uc }}</td>
                    <td>{{ $d->pengendalian }}</td>
                    <td>{{ $d->l_awal }}</td>
                    <td>{{ $d->c_awal }}</td>
                    <td>
                        @if($d->r_awal <= 5)
                          <button class="btn btn-sm btn-pill btn-success">
                        @elseif($d->r_awal >= 6 && $d->r_awal <= 11)
                          <button class="btn btn-sm btn-pill btn-warning">
                        @else
                          <button class="btn btn-sm btn-pill btn-danger">
                        @endif
                          {{ number_format($d->r_awal ,2) }}
                          </button>
                    </td>
                    <td>{{ $d->peluang }}</td>
                    <td>{{ $d->tindak_lanjut }}</td>
                    <td>{{ $d->jadwal_mitigasi }}</td>
                    <td>{{ $d->pic }}</td>
                    <td>{{ $d->dokumen }}</td>
                    <td>{{ $d->l_akhir }}</td>
                    <td>{{ $d->c_akhir }}</td>
                    <td>
                        @if($d->r_akhir <= 5)
                          <button class="btn btn-sm btn-pill btn-success">
                        @elseif($d->r_akhir>= 6 && $d->r_akhir <= 11)
                          <button class="btn btn-sm btn-pill btn-warning">
                        @else
                          <button class="btn btn-sm btn-pill btn-danger">
                        @endif
                          {{ number_format($d->r_akhir, 2) }}
                          </button>
                    </td>
                    <td>
                        @if($d->status == 0)
                          <button class="btn btn-sm btn-pill btn-warning" title="Dalam Proses">
                            Waiting
                          </button>
                        @else
                          <button class="btn btn-sm btn-pill btn-success" title="Pantau">
                            Verified
                          </button>
                        @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-danger btn-delete d-flex align-items-center" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#delete-risk-{{ $d->id_riskd }}">
                        <i class="fa fa-trash-o me-2"></i> Delete
                      </button>
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
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/summernote/summernote.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
  })
</script>
@endsection