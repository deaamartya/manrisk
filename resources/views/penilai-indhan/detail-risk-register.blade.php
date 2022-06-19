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
                <div class="col-md-3"><h6>Penyusun</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{{ $headers->penyusun }}</div>
                <div class="col-md-3"><h6>Pemeriksa</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-3">{{ $headers->pemeriksa }}</div>
              </div>
              <div class="col-md-6">
                <div class="col-md-5"><h6>Sasaran / Target</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-2">{!! nl2br($headers->target) !!}</div>
                <div class="col-md-5">
                  <h6>Status</h6>
                  <hr class="hr-custom">
                </div>
                <div class="col-md-12 mb-2">
                  @if($headers->status_h == 0)
                  <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval Risk Owner</span>
                  @elseif($headers->status_h == 1)
                  <span class="badge badge-success"><i class="fa fa-check"></i> Approved Risk Owner</span>
                  @endif

                  @if($headers->status_h_indhan == 0)
                  <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval INDHAN</span>
                  @elseif($headers->status_h_indhan == 1)
                  <span class="badge badge-success"><i class="fa fa-check"></i> Approved INDHAN</span>
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
                <span class="badge badge-green me-2"> </span>Rendah
              </div>
              <div class="col">
                <span class="badge badge-warning me-2"> </span>Menengah
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
              <table class="display" id="table-risiko">
                <thead>
                  <tr>
                    <th>Id Risk</th>
                    <th>INDHAN</th>
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
                        @if($d->status_indhan == 0)
                        <form action="{{ route('penilai-indhan.korporate', $d->id_riskd) }}" method="POST">
                          @csrf
                          <input type="hidden" name="id_risk" value="{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k  }}">
                          <button type="submit" class="btn btn-sm btn-pill btn-green d-flex align-items-center">
                            <i class="fa fa-times me-2"></i>Bukan INDHAN
                          </button>
                        </form>
                        @elseif($d->status_indhan == 1)
                        <form action="{{ route('penilai-indhan.unkorporate', $d->id_riskd) }}" method="POST">
                          @csrf
                          <input type="hidden" name="id_risk" value="{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k  }}">
                          <button type="submit" class="btn btn-sm btn-pill btn-danger d-flex align-items-center">
                            <i class="fa fa-check me-2"></i> INDHAN
                          </button>
                        </form>
                        @endif
                    </td>
                    <td>
                        @if($d->status_mitigasi == 0)
                        <form action="{{ route('penilai-indhan.mitigation', $d->id_riskd) }}" method="POST">
                          @csrf
                          <input type="hidden" name="id_risk" value="{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k  }}">
                          <button type="submit" class="btn btn-sm btn-pill btn-green d-flex align-items-center">
                            <i class="fa fa-times me-2"></i> Tidak Mitigasi
                          </button>
                        </form>
                        @else
                        <form action="{{ route('penilai-indhan.not-mitigation', $d->id_riskd) }}" method="POST">
                          @csrf
                          <input type="hidden" name="id_risk" value="{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k  }}">
                          <button type="submit" class="btn btn-sm btn-pill btn-danger d-flex align-items-center">
                            <i class="fa fa-check me-2"></i> Perlu Mitigasi
                          </button>
                        </form>
                        @endif
                    </td>
                    <td>{{ $d->sumber_risiko->konteks->konteks }}</td>
                    <td>{{ $d->indikator }}</td>
                    <td>{{ $d->sumber_risiko->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ $d->dampak }}</td>
                    <td>{{ $d->uc }}</td>
                    <td>{{ $d->pengendalian }}</td>
                    <td>{{ number_format($d->l_awal, 2) + 0 }}</td>
                    <td>{{ number_format($d->c_awal, 2) + 0 }}</td>
                    <td>
                      @if($d->r_awal < 6)
                      <span class="badge badge-green me-2">
                      @elseif($d->r_awal < 12)
                      <span class="badge badge-warning me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($d->r_awal, 2) + 0 }}
                      </span>
                    </td>
                    <td>{{ $d->peluang }}</td>
                    <td>{{ $d->tindak_lanjut }}</td>
                    <td>{{ date('d M Y', strtotime($d->jadwal_mitigasi)) }}</td>
                    <td>{{ $d->pic }}</td>
                    <td>{{ $d->dokumen }}</td>
                    <td>{{ $d->l_akhir }}</td>
                    <td>{{ $d->c_akhir }}</td>
                    <td>
                          @if($d->r_akhir < 6)
                          <span class="badge badge-blue me-2">
                          @elseif($d->r_akhir < 12)
                          <span class="badge badge-green me-2">
                          @elseif($d->r_akhir < 16)
                          <span class="badge badge-warning me-2">
                          @elseif($d->r_akhir < 20)
                          <span class="badge badge-orange me-2">
                          @else
                          <span class="badge badge-danger me-2">
                          @endif
                          {{ number_format($d->r_akhir, 2) + 0 }}
                          </span>
                    </td>
                    <td>
                        @if($d->status == 0)
                          <button class="btn btn-sm btn-pill btn-warning" title="Dalam Proses">
                            Waiting
                          </button>
                        @else
                          <button class="btn btn-sm btn-pill btn-green" title="Pantau">
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

@foreach($headers->risk_detail as $data)
<div class="modal fade" id="delete-risk-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('penilai-indhan.risk-detail-delete', $data->id_riskd) }}" method="POST">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id_risk" value="{{ $data->sumber_risiko->konteks->id_risk .'-'. $data->sumber_risiko->konteks->no_k  }}">
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data {{ $data->sumber_risiko->konteks->id_risk .'-'. $data->sumber_risiko->konteks->no_k  }} ?</p>
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
    $("#table-risiko").DataTable({
      'order': [ 12, 'desc' ]
    });
  })
</script>
@endsection