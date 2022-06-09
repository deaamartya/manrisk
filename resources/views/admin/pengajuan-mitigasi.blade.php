@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
@endsection

@section('page-title')
<h3>Pengajuan Mitigasi</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Pengajuan Mitigasi</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
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
              <table class="display" id="table-risiko">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Instansi</th>
                    <th>Risiko</th>
                    <th>R Awal</th>
                    <th>Pemohon</th>
                    <th>Tipe Pengajuan</th>
                    <th>Alasan Pengajuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pengajuan as $d)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->pemohon->perusahaan->instansi }}</td>
                    <td>{{ $d->risk_detail->sumber_risiko->s_risiko }}</td>
                    <td>
                      @if($d->risk_detail->r_awal < 6)
                      <span class="badge badge-blue me-2">
                      @elseif($d->risk_detail->r_awal < 12)
                      <span class="badge badge-green me-2">
                      @elseif($d->risk_detail->r_awal < 16)
                      <span class="badge badge-warning me-2">
                      @elseif($d->risk_detail->r_awal < 20)
                      <span class="badge badge-orange me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($d->risk_detail->r_awal ,2) }}
                      </span>
                    </td>
                    <td>{{ $d->pemohon->name }}</td>
                    <td>
                      @if ($d->tipe_pengajuan === 0)
                      <div class="text-danger">Tidak Perlu Mitigasi</div>
                      @elseif ($d->tipe_pengajuan === 1)
                      <div class="text-success">Perlu Mitigasi</div>
                      @endif
                    </td>
                    <td>{{ $d->alasan }}</td>
                    <td class="column-action">
                      @if ($d->status === 0)
                        <button class="btn btn-xs btn-primary flex-center" data-id="{{ $d->id }}" data-bs-toggle="modal" data-bs-target="#confirm-pengajuan-{{ $d->id }}">
                          <i data-feather="check" class="small-icon" height="16"></i> Setujui
                        </button>
                        <button class="btn btn-xs btn-danger flex-center" data-id="{{ $d->id }}" data-bs-toggle="modal" data-bs-target="#decline-pengajuan-{{ $d->id }}">
                          <i data-feather="x" class="small-icon" height="16"></i> Tolak
                        </button>
                      @else
                        <button class="btn btn-xs btn-danger flex-center" data-id="{{ $d->id }}" data-bs-toggle="modal" data-bs-target="#detail-pengajuan-{{ $d->id }}">
                          <i data-feather="eye" class="small-icon" height="16"></i> Detail
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
@foreach($pengajuan as $d)
<div class="modal fade" id="confirm-pengajuan-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Terima Pengajuan Mitigasi</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.mitigasi-plan.update', $d->id) }}">
          @method('PUT')
          @csrf
          <input type="hidden" value="1" name="status">
          <input type="hidden" value="1" name="is_approved">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Pemohon</strong></div>
                <p>{{ $d->pemohon->name }}</p>
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Risiko</strong></div>
                <p>{{ $d->risk_detail->sumber_risiko->s_risiko  }}</p>
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>R Awal</strong></div>
                <p>{{ $d->risk_detail->r_awal  }}</p>
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Tipe Pengajuan</strong></div>
                @if ($d->tipe_pengajuan === 0)
                <div class="text-danger">Tidak Perlu Mitigasi</div>
                @elseif ($d->tipe_pengajuan === 1)
                <div class="text-success">Perlu Mitigasi</div>
                @endif
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Alasan Pengajuan</strong></div>
                <p>{{ $d->alasan }}</p>
              </div>
              <div class="col-md-6">
                <div class="pb-2"><strong>Waktu Pengajuan</strong></div>
                <p>{{ date('d M Y H:i:s', strtotime($d->created_at)) }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Alasan</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="alasan_admin"></textarea>
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
<div class="modal fade" id="decline-pengajuan-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Tolak Pengajuan Mitigasi</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('admin.mitigasi-plan.update', $d->id) }}">
          @method('PUT')
          @csrf
          <input type="hidden" value="1" name="status">
          <input type="hidden" value="0" name="is_approved">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Pemohon</strong></div>
                <p>{{ $d->pemohon->name }}</p>
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Risiko</strong></div>
                <p>{{ $d->risk_detail->sumber_risiko->s_risiko  }}</p>
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>R Awal</strong></div>
                <p>{{ $d->risk_detail->r_awal  }}</p>
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Tipe Pengajuan</strong></div>
                @if ($d->tipe_pengajuan === 0)
                <div class="text-danger">Tidak Perlu Mitigasi</div>
                @elseif ($d->tipe_pengajuan === 1)
                <div class="text-success">Perlu Mitigasi</div>
                @endif
              </div>
              <div class="col-md-6 pb-3">
                <div class="pb-2"><strong>Alasan Pengajuan</strong></div>
                <p>{{ $d->alasan }}</p>
              </div>
              <div class="col-md-6">
                <div class="pb-2"><strong>Waktu Pengajuan</strong></div>
                <p>{{ date('d M Y H:i:s', strtotime($d->created_at)) }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Alasan Penolakan<small class="text-danger">*</small></label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="alasan_admin" required></textarea>
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
<div class="modal fade" id="detail-pengajuan-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Pengajuan</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Pemohon</strong></div>
              <p>{{ $d->pemohon->name }}</p>
            </div>
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Risiko</strong></div>
              <p>{{ $d->risk_detail->sumber_risiko->s_risiko  }}</p>
            </div>
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>R Awal</strong></div>
              <p>{{ $d->risk_detail->r_awal  }}</p>
            </div>
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Tipe Pengajuan</strong></div>
              @if ($d->tipe_pengajuan === 0)
              <div class="text-danger">Tidak Perlu Mitigasi</div>
              @elseif ($d->tipe_pengajuan === 1)
              <div class="text-success">Perlu Mitigasi</div>
              @endif
            </div>
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Alasan Pengajuan</strong></div>
              <p>{{ $d->alasan }}</p>
            </div>
            <div class="col-md-6">
              <div class="pb-2"><strong>Waktu Pengajuan</strong></div>
              <p>{{ date('d M Y H:i:s', strtotime($d->created_at)) }}</p>
            </div>
          </div>
          <hr>
          @if($d->status === 1)
          <div class="row">
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Jawaban</strong></div>
              @if ($d->is_approved === 0)
              <div class="text-danger">Ditolak</div>
              @elseif ($d->is_approved === 1)
              <div class="text-success">Diterima</div>
              @endif
            </div>
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Alasan Admin</strong></div>
              <p>{{ $d->alasan_admin }}</p>
            </div>
            <div class="col-md-6 pb-3">
              <div class="pb-2"><strong>Waktu Konfirmasi</strong></div>
              <p>{{ date('d M Y H:i:s', strtotime($d->updated_at)) }}</p>
            </div>
          </div>
          @endif
        </div>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('custom-script')
<script>
  $(document).ready(function(){
    $("#table-risiko").DataTable({
      'order': [ 3, 'desc' ]
    });
  })
</script>
@endsection