@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
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
          <div class="card-header d-flex">
            <button class="btn btn-lg btn-primary d-flex btn-add mr-4" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#create-risk">
              <i data-feather="plus" class="me-2"></i>
              Tambah Risiko INDHAN
            </button>
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
                    <th>Aksi</th>
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
                    <td>{{ number_format($d->nilai_l, 2) + 0 }}</td>
                    <td>{{ number_format($d->nilai_c, 2) + 0 }}</td>
                    @php
                      $nilai_r = number_format($d->nilai_l * $d->nilai_c, 2) + 0;
                    @endphp
                    <td>
                      @if($nilai_r < 6)
                      <span class="badge badge-green me-2">
                      @elseif($nilai_r < 12)
                      <span class="badge badge-warning me-2">
                      @elseif($nilai_r < 16)
                      <span class="badge badge-pink me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($nilai_r, 2) + 0 }}
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
                    <td>
                    </td>
                  </tr>
                  @endforeach
                @endif

                @if($detail_risk_indhan != null )
                  @foreach($detail_risk_indhan as $d2)
                  <tr>
                    <td>{{ $d2->id_risk .'-'. $d2->no_k }}</td>
                    <td>{{ $d2->instansi }}</td>
                    <td>{{ $d2->konteks }}</td>
                    <td>{{ $d2->s_risiko }}</td>
                    <td>{{ $d2->sebab }}</td>
                    <td>{{ number_format($d2->l_awal, 2) + 0 }}</td>
                    <td>{{ number_format($d2->c_awal, 2) + 0 }}</td>
                    <td>
                      @if($d2->r_awal < 6)
                      <span class="badge badge-green me-2">
                      @elseif($d2->r_awal < 12)
                      <span class="badge badge-warning me-2">
                      @elseif($d2->r_awal < 16)
                      <span class="badge badge-pink me-2">
                      @else
                      <span class="badge badge-danger me-2">
                      @endif
                      {{ number_format($d2->r_awal, 2) + 0 }}
                      </span>
                    </td>
                    <td>
                        @if($d2->r_awal >= 12)
                          <span class="badge badge-primary">Ajukan Mitigasi</span>
                        @elseif($d2->r_awal < 12)
                          <span class="badge badge-success">Aman</span>
                        @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $d2->id_riskd }}" data-bs-toggle="modal" data-bs-target="#edit-risk-{{ $d2->id_riskd }}">
                        <i data-feather="edit-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $d2->id_riskd }}" data-bs-toggle="modal" data-bs-target="#delete-risk-{{ $d2->id_riskd }}">
                        <i data-feather="trash-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-secondary btn-detail" data-id="{{ $d2->id_riskd }}" data-bs-toggle="modal" data-bs-target="#detail-risk-{{ $d2->id_riskd }}">
                        <i data-feather="search" class="small-icon"></i>
                      </button>
                    </td>
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
        <form method="POST" action="{{ route('admin.upload-lampiran-risk-register-indhan') }}" enctype="multipart/form-data">
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
      <form action="{{ route('admin.risk-detail.import') }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="create-risk" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Risk INDHAN</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form action="{{ route('admin.risk-detail.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_riskh" value="{{ $headers->id_riskh }}">
            <input type="hidden" name="tahun" value="{{ $headers->tahun }}">
            <input type="hidden" name="status_indhan" value="1">
            <input type="hidden" name="status_mitigasi" value="0">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Identifikasi</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Sasaran Kinerja</label>
                    <textarea class="form-control" name="sasaran_kinerja" placeholder="Masukkan Sasaran Kinerja"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Risiko</label>
                    <select class="select2" name="id_s_risiko" required id="select-risiko">
                      @foreach($pilihan_s_risiko as $p)
                      <option value="{{ $p->id_s_risiko }}">{{ $p->tahun }} - {{ $p->s_risiko }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group pt-2">
                    <label>PPKH</label>
                    <textarea class="form-control" name="ppkh" placeholder="Masukkan Penyebab Temuan"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Indikator</label>
                    <textarea class="form-control" name="indikator" placeholder="Masukkan Indikator"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Sebab</label>
                    <textarea class="form-control" name="sebab" placeholder="Masukkan sebab"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif</label>
                    <input type="number" min="0" class="form-control" name="dampak_kuantitatif" placeholder="Masukkan nominal">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko</label>
                    <textarea class="form-control" name="dampak" placeholder="Masukkan dampak"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>UC / C</label>
                    <select class="form-control" name="uc">
                      <option value="UC">UC</option>
                      <option value="C">C</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Pengendalian dan Penilaian Awal</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Pengendalian</label>
                    <textarea class="form-control" name="pengendalian" placeholder="Masukkan pengendalian"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Penilaian</label>
                    <textarea class="form-control" name="penilaian" placeholder="Masukkan penilaian"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>L</label>
                    <input type="number" class="form-control" min="1" max="5" onkeyup="cal()" step="0.01" name="l_awal" id="l_awal" placeholder="Nilai L" value="{{ number_format($nilai_l, 2) + 0 }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" class="form-control" min="1" max="5" onkeyup="cal()" step="0.01" name="c_awal" id="c_awal" placeholder="Nilai C" value="{{ number_format($nilai_c, 2) + 0 }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" class="form-control" min="1" max="5" name="r_awal" id="r_awal" placeholder="Nilai R" readonly value="{{ number_format($nilai_l * $nilai_c, 2) + 0 }}">
                  </div>
                </div>
              </div>
              <div class="row pt-5">
                <div class="col-md-6">
                  <h6>Peluang</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Peluang</label>
                    <textarea class="form-control" name="peluang" placeholder="Masukkan peluang"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Penanganan</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Rencana Tindak Lanjut</label>
                    <textarea class="form-control" name="tindak_lanjut"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Jadwal Pelaksanaan</label>
                      <div class="date-picker">
                        <input class="datepicker-here form-control digits" type="text" placeholder="Jadwal Pelaksanaan" data-language="en" name="jadwal">
                      </div>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif Residual</label>
                    <input type="number" min="0" class="form-control" name="dampak_kuantitatif_residu" placeholder="Masukkan nominal">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko Residual</label>
                    <textarea class="form-control" name="dampak_residu" placeholder="Masukkan dampak"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>PIC</label>
                    <input type="text" class="form-control" name="pic" placeholder="PIC divisi"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Dokumen Terkait</label>
                    <textarea class="form-control" name="dokumen"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-link" type="button" data-bs-dismiss="modal">Cancel</button>
              <button class="btn btn-success" type="submit">Simpan</button>
            </div>
          </form>
    </div>
  </div>
</div>

@foreach($detail_risk_indhan as $data)
<div class="modal fade" id="detail-risk-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lihat Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <input type="hidden" name="id_riskh" value="{{ $headers->id_riskh }}">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Identifikasi</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Sasaran Kinerja</label>
                    <textarea class="form-control" name="sasaran_kinerja" readonly>{{ $data->sasaran_kinerja }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Risiko</label>
                    <input type="text" class="form-control" readonly value="{{ $data->sumber_risiko->s_risiko }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>PPKH</label>
                    <textarea class="form-control" name="ppkh" placeholder="Masukkan Penyebab Temuan" readonly>{{ $data->ppkh }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Indikator</label>
                    <textarea class="form-control" name="indikator" placeholder="Masukkan Indikator" readonly>{{ $data->indikator }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Sebab</label>
                    <textarea class="form-control" name="sebab" placeholder="Masukkan sebab" readonly>{{ $data->sebab }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif</label>
                    <input type="text" class="form-control" readonly value="{{ number_format($data->dampak_kuantitatif,2,',','.') }}"> 
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko</label>
                    <textarea class="form-control" name="dampak" placeholder="Masukkan dampak" readonly>{{ $data->dampak }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>UC / C</label>
                    <input type="text" class="form-control" readonly value="{{ $data->uc }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Pengendalian dan Penilaian Awal</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Pengendalian</label>
                    <textarea class="form-control" name="pengendalian" placeholder="Masukkan pengendalian" readonly>{{ $data->pengendalian }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Penilaian</label>
                    <textarea class="form-control" name="penilaian" readonly>{{ $data->penilaian }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>L</label>
                    <input type="number" class="form-control" name="l_awal" id="l_detail_awal_{{ $data->id_riskd }}" placeholder="Nilai L" value="{{ number_format($data->l_awal, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" class="form-control" name="c_awal" id="c_detail_awal_{{ $data->id_riskd }}" placeholder="Nilai C" value="{{ number_format($data->c_awal, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" class="form-control" name="r_awal" placeholder="Nilai R" readonly value="{{ number_format($data->r_awal, 2) + 0 }}">
                  </div>
                </div>
              </div>
              <div class="row pt-5">
                <div class="col-md-6">
                  <h6>Peluang</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Peluang</label>
                    <textarea class="form-control" name="peluang" placeholder="Masukkan peluang" readonly>{{ $data->peluang }}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Penanganan</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Rencana Tindak Lanjut</label>
                    <textarea class="form-control" name="tindak_lanjut" readonly>{{ $data->tindak_lanjut }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Jadwal Pelaksanaan</label>
                    <input type="text" class="form-control" name="jadwal" placeholder="Jadwal Pelaksanaan" value="{{ date('d M Y', strtotime($data->jadwal))}}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif Residual</label>
                    <input type="text" class="form-control" value="{{ number_format($data->dampak_kuantitatif_residu,2,',','.') }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko Residual</label>
                    <textarea class="form-control" name="dampak_residu" readonly>{{ $data->dampak_residu }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>PIC</label>
                    <input type="text" class="form-control" name="pic" placeholder="PIC divisi" value="{{ $data->pic }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>Dokumen Terkait</label>
                    <textarea class="form-control" name="dokumen" readonly>{{ $data->dokumen }}</textarea>
                  </div>
                </div>
              </div>
            </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit-risk-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form action="{{ route('admin.risk-detail.update', $data->id_riskd) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id_riskh" value="{{ $headers->id_riskh }}">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Identifikasi</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Sasaran Kinerja</label>
                    <textarea class="form-control" name="sasaran_kinerja">{{ $data->sasaran_kinerja }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Risiko</label>
                    <select id="select-risk-edit-{{ $data->id_riskd }}" class="select2 select-edit-risiko" data-id="{{ $data->id_riskd }}" name="id_s_risiko" required>
                    </select>
                  </div>
                  <div class="form-group pt-2">
                    <label>PPKH</label>
                    <textarea class="form-control" name="ppkh" placeholder="Masukkan Penyebab Temuan">{{ $data->ppkh }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Indikator</label>
                    <textarea class="form-control" name="indikator" placeholder="Masukkan Indikator">{{ $data->indikator }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Sebab</label>
                    <textarea class="form-control" name="sebab" placeholder="Masukkan sebab">{{ $data->sebab }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif</label>
                    <input type="number" min="0" class="form-control" value="{{ $data->dampak_kuantitatif }}"> 
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko</label>
                    <textarea class="form-control" name="dampak" placeholder="Masukkan dampak">{{ $data->dampak }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>UC / C</label>
                    <select class="form-control" name="uc">
                      <option @if($data->UC == 'UC') selected @endif>UC</option>
                      <option @if($data->UC == 'C') selected @endif>C</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Pengendalian dan Penilaian Awal</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Pengendalian</label>
                    <textarea class="form-control" name="pengendalian" placeholder="Masukkan pengendalian">{{ $data->pengendalian }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Penilaian</label>
                    <textarea class="form-control" name="penilaian">{{ $data->penilaian }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>L</label>
                    <input type="text" class="form-control" onkeyup="calEdit({{ $data->id_riskd }})" step="0.01" name="l_awal" id="l_awal_{{ $data->id_riskd }}" placeholder="Nilai L" value="{{ number_format($data->l_awal, 2) + 0 }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="text" class="form-control" onkeyup="calEdit({{ $data->id_riskd }})" step="0.01" name="c_awal" id="c_awal_{{ $data->id_riskd }}" placeholder="Nilai C" value="{{ number_format($data->c_awal, 2) + 0 }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="text" class="form-control" name="r_awal" id="r_awal_{{ $data->id_riskd }}" step="0.01" placeholder="Nilai R" value="{{ number_format($data->r_awal, 2) + 0 }}">
                  </div>
                </div>
              </div>
              <div class="row pt-5">
                <div class="col-md-6">
                  <h6>Peluang</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Peluang</label>
                    <textarea class="form-control" name="peluang" placeholder="Masukkan peluang">{{ $data->peluang }}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Penanganan</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Rencana Tindak Lanjut</label>
                    <textarea class="form-control" name="tindak_lanjut">{{ $data->tindak_lanjut }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Jadwal Pelaksanaan</label>
                    <!-- <input type="date" class="form-control" name="jadwal" placeholder="Jadwal Pelaksanaan" value="{{ $data->jadwal }}"> -->
                    <div class="date-picker">
                          <input class="datepicker-here form-control digits" type="text" placeholder="Jadwal Pelaksanaan" value="{{ $data->jadwal }}" data-language="en" name="jadwal">
                        </div>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif Residual</label>
                    <input type="number" min="0" class="form-control" value="{{ $data->dampak_kuantitatif_residu }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko Residual</label>
                    <textarea class="form-control" name="dampak_residu">{{ $data->dampak_residu }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>PIC</label>
                    <input type="text" class="form-control" name="pic" placeholder="PIC divisi" value="{{ $data->pic }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dokumen Terkait</label>
                    <textarea class="form-control" name="dokumen">{{ $data->dokumen }}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-link" type="button" data-bs-dismiss="modal">Cancel</button>
              <button class="btn btn-success" type="submit">Simpan</button>
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
        <form action="{{ route('admin.risk-detail.destroy', $data->id_riskd) }}" method="POST">
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
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
    $("#table-risiko").DataTable({
      'order': [ 7, 'desc' ]
    });
    $("#select-risiko").on('change', function(){
      $.post(
        "{{ url('admin/fetchNilaiRisiko') }}", {
          _token: "{{ csrf_token() }}",
          id: $(this).val()
        }, function(result) {
          $("#l_awal").val(parseFloat(result.nilai_l).toFixed(2))
          $("#c_awal").val(parseFloat(result.nilai_c).toFixed(2))
          var mul = parseFloat(result.nilai_l) * parseFloat(result.nilai_c);
          $('#r_awal').val(mul.toFixed(2));
        }
      )
    });
    $(".btn-edit").on('click', function(){
      var id_risk = $(this).attr("data-id");
      $.post(
          "{{ url('admin/getRisikoSelected') }}", {
            _token: "{{ csrf_token() }}",
            id:  id_risk
          }, function(result) {
            $('#select-risk-edit-'+id_risk).empty();

            for(var i = 0; i<result.all_s_risiko.length; i++){
              var is_selected = false;
              if(result.all_s_risiko[i].id_s_risiko == result.s_risk_selected ){
                is_selected = true;
              }
              var cekInclude = result.pilihan_s_risiko.includes(result.all_s_risiko[i].id_s_risiko);
              if ( cekInclude == false || result.all_s_risiko[i].id_s_risiko == result.s_risk_selected ) {
                var text = result.all_s_risiko[i].tahun+" - "+ result.all_s_risiko[i].s_risiko;
                var option = new Option(text, result.all_s_risiko[i].id_s_risiko, false, is_selected);
                $('#select-risk-edit-'+id_risk).append(option).trigger("change");
              }
					  }
          }
        )
    });
    $(".select-edit-risiko").on('change', function(){
      const id = $(this).attr("data-id");
      $.post(
        "{{ url('admin/fetchNilaiRisiko') }}", {
          _token: "{{ csrf_token() }}",
          id: $(this).val()
        }, function(result) {
          $("#l_awal_"+id).val(parseFloat(result.nilai_l).toFixed(2))
          $("#c_awal_"+id).val(parseFloat(result.nilai_c).toFixed(2))
          var mul = parseFloat(result.nilai_l) * parseFloat(result.nilai_c);
          $('#r_awal_'+id).val(mul.toFixed(2));
        }
      )
    });
  });
  function cal() {
    var lawal = parseFloat($('#l_awal').val());
    var cawal = parseFloat($('#c_awal').val());
    var mul = lawal * cawal;
    $('#r_awal').val(mul);
  }
  function calEdit(id) {
    var lawal = parseFloat($('#l_awal_'+id).val());
    var cawal = parseFloat($('#c_awal_'+id).val());
    var mul = lawal * cawal;
    $('#r_awal_'+id).val(mul);
  }
</script>
@endsection
