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
                  <div class="badge badge-warning">Waiting for Approval</div>
                  <div class="badge badge-success">Approved</div>
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
                    <th>Indhan</th>
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
                      @if($d->status_korporasi === 1)
                        <a href="{{ route('risk-owner.toggleIndhan', $d->id_riskd) }}" class="btn btn-sm btn-success">
                          Bukan Indhan
                        </a>
                      @elseif($d->status_korporasi === 0)
                        <a href="{{ route('risk-owner.toggleIndhan', $d->id_riskd) }}" class="btn btn-sm btn-primary">
                          Indhan
                        </a>
                      @endif
                    </td>
                    <td>
                      @if(count($d->pengajuan_mitigasi) === 1)
                      <span>Aksi Mitigasi telah diajukan</span>
                      @else
                        @if($d->r_awal >= 12)
                          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Tidak Perlu Mitigasi
                          </button>
                        @elseif($d->r_awal < 12)
                          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Ajukan Mitigasi
                          </button>
                        @endif
                      @endif
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
                      @if($d->r_awal > 12) 
                      <div class="badge badge-sm badge-success">
                      @else
                      <div class="badge badge-sm badge-danger">
                      @endif
                      {{ $d->r_awal }}
                      </div>
                    </td>
                    <td>{{ $d->peluang }}</td>
                    <td>{{ $d->tindak_lanjut }}</td>
                    <td>{{ $d->jadwal }}</td>
                    <td>{{ $d->pic }}</td>
                    <td>{{ $d->dokumen }}</td>
                    <td>{{ $d->l_akhir }}</td>
                    <td>{{ $d->c_akhir }}</td>
                    <td>
                      @if($d->r_awal > 12) 
                      <div class="badge badge-sm badge-success">
                      @else
                      <div class="badge badge-sm badge-danger">
                      @endif
                      {{ $d->r_akhir }}
                      </div>
                    </td>
                    <td>
                      @if($headers->status_h === 0)
                        <div class="badge badge-sm badge-danger">Waiting</div>
                      @elseif($headers->status_h === 1)
                        <div class="badge badge-sm badge-success">Verified</div>
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#delete-risk-{{ $d->id_riskd }}">
                        <i data-feather="trash-2" class="small-icon"></i>
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