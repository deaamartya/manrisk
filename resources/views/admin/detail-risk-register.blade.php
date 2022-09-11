@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
@endsection

@section('page-title')
<h3>Detail Risk Register Korporasi</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Risk Register Korporasi</li>
<li class="breadcrumb-item active">Detail Risk Register Korporasi</li>
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
                <div class="col-md-12 mb-2">{{ ($headers->penyusun ? $headers->penyusun->name : '-') }}</div>
                <div class="col-md-3"><h6>Pemeriksa</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-3">{{ ($headers->pemeriksa ? $headers->pemeriksa->name : '-') }}</div>
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
                <span class="badge badge-pink me-2"> </span>Tinggi
              </div>
              <div class="col">
                <span class="badge badge-danger me-2"> </span>Ekstrim
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
                    <td>{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->no_urut }}</td>
                    <td>
                        @if($d->status_indhan == 0)
                          <button class="btn btn-sm btn-pill btn-green d-flex align-items-center" data-bs-target="#bukan-indhan-{{ $d->id_riskd }}" data-bs-toggle="modal">
                            <i class="fa fa-times me-2"></i>Bukan INDHAN
                          </button>
                        @elseif($d->status_indhan == 1)
                        <button class="btn btn-sm btn-pill btn-danger d-flex align-items-center" data-bs-target="#indhan-{{ $d->id_riskd }}" data-bs-toggle="modal">
                            <i class="fa fa-check me-2"></i>INDHAN
                          </button>
                        @endif
                    </td>
                    <td>
                      @if($d->status_mitigasi == 0)
                        <button class="btn btn-sm btn-pill btn-green d-flex align-items-center" data-bs-target="#ajukan-mitigasi-{{ $d->id_riskd }}" data-bs-toggle="modal">
                        <i class="fa fa-check me-2"></i>Perlu Mitigasi
                        </button>
                      @elseif($d->status_mitigasi == 1)
                      <button class="btn btn-sm btn-pill btn-danger d-flex align-items-center" data-bs-target="#ajukan-mitigasi-{{ $d->id_riskd }}" data-bs-toggle="modal">
                          <i class="fa fa-times me-2"></i>Tidak Mitigasi
                        </button>
                      @endif
                    </td>
                    <td>{{ $d->sumber_risiko->konteks->konteks }}</td>
                    <td>{{ $d->indikator }}</td>
                    <td>{{ $d->sumber_risiko->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ $d->dampak }}</td>
                    <td>{{ $d->uc }}</td>
                    <td>{{ $d->pengendalian }}</td>
                    <td>{{ number_format($d->l_awal,2) + 0 }}</td>
                    <td>{{ number_format($d->c_awal,2) + 0 }}</td>
                    <td>
                      @if($d->r_awal < 6)
                      <span class="badge badge-green me-2">
                      @elseif($d->r_awal < 12)
                      <span class="badge badge-warning me-2">
                      @elseif($d->r_awal < 16)
                      <span class="badge badge-pink me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($d->r_awal,2) + 0 }}
                      </span>
                    </td>
                    <td>{{ $d->peluang }}</td>
                    <td>{{ $d->tindak_lanjut }}</td>
                    <td>
                      @if($d->jadwal_mitigasi != null)
                        {{ date('d M Y', strtotime($d->jadwal_mitigasi)) }}
                      @endif
                    </td>
                    <td>{{ $d->pic }}</td>
                    <td>{{ $d->dokumen }}</td>
                    <td>{{ $d->l_akhir }}</td>
                    <td>{{ $d->c_akhir }}</td>
                    <td>
                      @if($d->r_akhir < 6)
                      <span class="badge badge-green me-2">
                      @elseif($d->r_akhir < 12)
                      <span class="badge badge-warning me-2">
                      @elseif($d->r_akhir < 16)
                      <span class="badge badge-pink me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($d->r_akhir ,2) }}
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
<div class="modal fade" id="bukan-indhan-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Status INDHAN</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="GET" action="{{ route('admin.risk-register-korporasi.indhan', $data->id_riskd) }}">
        <div class="modal-body">
        <input type="hidden" name="id_risk" value="{{ $data->sumber_risiko->konteks->id_risk .'-'. $data->no_urut }}">
          Apakah Anda yakin menyimpan risiko ini sebagai risiko INDHAN?
        </div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">Tidak</button>
          <button class="btn btn-primary" type="submit">Ya, saya yakin</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="indhan-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Status INDHAN</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="GET" action="{{ route('admin.risk-register-korporasi.non-indhan', $data->id_riskd) }}">
        <div class="modal-body">
        <input type="hidden" name="id_risk" value="{{ $data->sumber_risiko->konteks->id_risk .'-'. $data->no_urut }}">
          Apakah Anda yakin menyimpan risiko ini sebagai risiko BUKAN INDHAN?
        </div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">Tidak</button>
          <button class="btn btn-primary" type="submit">Ya, saya yakin</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ajukan-mitigasi-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        @if ($data->status_mitigasi === 1)
        <h5 class="modal-title">Tidak Perlu Mitigasi</h5>
        @elseif ($data->status_mitigasi === 0)
        <h5 class="modal-title">Perlu Mitigasi</h5>
        @endif
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      @if ($data->status_mitigasi === 0)
      <form method="POST" action="{{ url('/admin/risk-detail-mitigation', $data->id_riskd) }}">
      @elseif ($data->status_mitigasi === 1)
      <form method="POST" action="{{ url('/admin/risk-detail-not-mitigation', $data->id_riskd) }}">
      @endif
        @csrf
        <input type="hidden" value="{{ $data->id_riskd }}" name="id_risk_detail">
        <div class="modal-body">Apakah Anda yakin ingin mengubah status mitigasi risiko ini menjadi
          @if ($data->status_mitigasi === 1)
          <strong>Tidak Perlu Mitigasi</strong>
          @elseif ($data->status_mitigasi === 0)
          <strong>Perlu Mitigasi</strong>
          @endif
        ?</div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">Tidak</button>
          <button class="btn btn-primary" type="submit">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="delete-risk-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.risk-detail-delete', $data->id_riskd) }}" method="POST">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id_risk" value="{{ $data->sumber_risiko->konteks->id_risk .'-'. $data->no_urut }}">
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data {{ $data->sumber_risiko->konteks->id_risk .'-'. $data->no_urut }} ?</p>
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