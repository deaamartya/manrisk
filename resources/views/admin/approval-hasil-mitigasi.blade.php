@extends('layouts.user.table')
@section('title', 'Approval Hasil Mitigasi')
@section('style')
<style>
    .badge-secondary-cust {
        background-color:#ea2087
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Persetujuan Hasil Mitigasi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Persetujuan Hasil Mitigasi</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h5>ID HEADER # {{ $data['headers']->id_riskh }}</h5>

                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-4"><h6>Instansi</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-2">{{ $data['headers']->perusahaan->instansi }}</div>
                      <div class="col-md-4"><h6>Tahun Risiko</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-2">{{ $data['headers']->tahun }}</div>
                      <div class="col-md-4"><h6>Tanggal Dibuat</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-2">{{ date('d M Y', strtotime($data['headers']->tanggal)) }}</div>
                      <div class="col-md-3"><h6>Penyusun</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-2">{{ ($data['headers']->penyusun ? $data['headers']->penyusun->name : '-') }}</div>
                      <div class="col-md-3"><h6>Pemeriksa</h6><hr class="hr-custom"></div>
                      <div class="col-md-12">{{ ($data['headers']->pemeriksa ? $data['headers']->pemeriksa->name : '-') }}</div>
                    </div>
                    <div class="col-md-6">
                      <div class="col-md-5"><h6>Sasaran / Target</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-3">{!! nl2br($data['headers']->target) !!}</div>
                      <div class="col-md-5"><h6>Level Awal</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-3">
                        <span class="badge badge-secondary-cust">L {{ number_format($data['risk_detail']->l_awal, 2) + 0 }}</span>
                        <span class="badge badge-secondary-cust">C {{ number_format($data['risk_detail']->c_awal, 2) + 0 }}</span>
                        @if($data['risk_detail']->r_awal < 6)
                        <span class="badge badge-green me-2">
                        @elseif($data['risk_detail']->r_awal < 12)
                        <span class="badge badge-warning me-2">
                        @elseif($data['risk_detail']->r_awal < 16)
                        <span class="badge badge-pink me-2">
                        @else
                        <span class="badge badge-danger me-2">
                        @endif
                        R {{ number_format($data['risk_detail']->r_awal, 2) + 0 }}
                        </span>
                      </div>
                      <div class="col-md-5"><h6>Level Akhir</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-3">
                        <span class="badge badge-secondary-cust">L {{ number_format($data['risk_detail']->l_akhir, 2) + 0 }}</span>
                        <span class="badge badge-secondary-cust">C {{ number_format($data['risk_detail']->c_akhir, 2) + 0 }}</span>
                        @if($data['risk_detail']->r_akhir < 6)
                        <span class="badge badge-green me-2">
                        @elseif($data['risk_detail']->r_akhir < 12)
                        <span class="badge badge-warning me-2">
                        @elseif($data['risk_detail']->r_akhir < 16)
                        <span class="badge badge-pink me-2">
                        @else
                        <span class="badge badge-danger me-2">
                        @endif
                        R {{ number_format($data['risk_detail']->r_akhir, 2) + 0 }}
                        </span>
                      </div>
                      @if($data['headers']->lampiran != null || $data['headers']->lampiran != '')
                      <div class="col-md-5 mb-2">
                        <h6>Lampiran</h6>
                        <hr class="hr-custom">
                      </div>
                      <div class="col-md-12 mb-3">
                        <a href="{{ asset('document/lampiran/'. $data['headers']->lampiran) }}" class="btn btn-sm btn-danger mb-3">
                          <span class="flex-center">
                            <i data-feather="download" class="me-2"></i>{{ $data['headers']->lampiran }}
                          </span>
                        </a>
                      </div>
                      @endif
                      <div class="col-md-5"><h6>Status</h6><hr class="hr-custom"></div>
                      <div class="col-md-12 mb-2" id="status_h_indhan">
                        @if($data['headers']->status_h == 0)
                        <span class="badge badge-warning"><i class="fa fa-warning"></i> Waiting Approval Risk Owner</span>
                        @elseif($data['headers']->status_h == 1)
                        <span class="badge badge-success"><i class="fa fa-check"></i> Approved Risk Owner</span>
                        @endif
                        @if($data['headers']->status_h_indhan == 0)
                        <span class="badge badge-warning" id="status_h_indhan_0"><i class="fa fa-warning"></i> Waiting Approval Admin</span>
                        @elseif($data['headers']->status_h_indhan == 1)
                        <span class="badge badge-success" id="status_h_indhan_1"><i class="fa fa-check"></i> Approved Admin</span>
                        @elseif($data['headers']->status_h_indhan == 2)
                        <span class="badge badge-danger" id="status_h_indhan_2"><i class="fa fa-close"></i> Not Approved Admin</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th style="width: 40px">No</th>
                                    <th>Deskripsi</th>
                                    <th>Dokumen</th>
                                    <th>% Realisasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['logs'] as $d)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td align="center">
                                        @if(!$d->dokumen)
                                            -
                                        @else
                                        <button class="btn btn-xs btn-primary p-1 flex-center" data-id="{{ $d->id }}" data-bs-toggle="modal" data-bs-target="#preview-document-{{ $d->id }}">
                                            <i data-feather="zoom-in" class="small-icon" height="13"></i>View File
                                        </button>
                                        @endif
                                    </td>
                                    @if(!$d->is_approved)
                                    <td align="center" style="width: 60px" id="data_realisasi">
                                        <select name="prosentase" class="form-control" id="realisasi_{{ $d->id }}" required>
                                            <option {{ $d->realisasi == '25' ? 'selected' : '' }} value="25">25 %</option>
                                            <option {{ $d->realisasi == '50' ? 'selected' : '' }} value="50">50 %</option>
                                            <option {{ $d->realisasi == '75' ? 'selected' : '' }} value="75">75 %</option>
                                            <option {{ $d->realisasi == '100' ? 'selected' : '' }} value="100">100 %</option>
                                        </select>
                                        {{-- <input type="number" class="realisasi" value="{{ $d->realisasi }}" id="{{ $d->id }}"> --}}
                                    </td>
                                    @else
                                    <td align="center" style="width: 60px">
                                        {{ $d->realisasi }}
                                        {{-- <input type="number" class="realisasi" value="{{ $d->realisasi }}" id="{{ $d->id }}" readonly> --}}
                                    </td>
                                    @endif
                                    <td align="center">
                                    @if($d->is_approved == 0)
                                      <button class="btn btn-warning btn-sm approve" id="approve_{{ $d->id }}"><i class="fa fa-check"></i> Approve</button>
                                      <button class="btn btn-danger btn-sm not-approve" id="not_approve_{{ $d->id }}"><i class="fa fa-close"></i> Not Approve</button>
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

@foreach ($data['logs'] as $dt)
<div class="modal fade" id="preview-document-{{ $dt->id }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Preview Document</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <embed src="{{ asset('document/lampiran-mitigasi/'.$dt->dokumen) }}" width="100%" height="500"/>
          </div>
      </div>
    </div>
  </div>
@endforeach

@endsection

@section('custom-script')
    <script>
        const user = {!! auth()->user()->toJson() !!}
        const headers = {!! json_encode($data['headers']->status_h_indhan) !!}
    </script>
    <script type="text/javascript" src="{{asset('assets/js/custom/approval_hasil_mitigasi.js')}}"></script>
@endsection
