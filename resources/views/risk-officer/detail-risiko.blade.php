@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
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
          <div class="card-header d-flex justify-content-between">
            <div class="product-page-details">
              <h3>ID HEADER # {{ $headers->id_riskh }}</h3>
            </div>
            <a href="{{ route('risk-officer.risiko.index') }}">
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
                <div class="col-md-12 mb-2">{{ ($headers->penyusun ? $headers->penyusun->name : '-') }}</div>
                <div class="col-md-3"><h6>Pemeriksa</h6><hr class="hr-custom"></div>
                <div class="col-md-12">{{ ($headers->pemeriksa ? $headers->pemeriksa->name : '-') }}</div>
              </div>
              <div class="col-md-6">
                <div class="col-md-5"><h6>Sasaran / Target</h6><hr class="hr-custom"></div>
                <div class="col-md-12 mb-3">{!! nl2br($headers->target) !!}</div>
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
                  <span class="badge badge-warning me-2"><i class="fa fa-warning"></i> Waiting Approval Risk Owner</span>
                  @elseif($headers->status_h == 1)
                  <span class="badge badge-success me-2"><i class="fa fa-check"></i> Approved Risk Owner</span>
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
          <div class="card-header d-flex justify-content-between">
            <button class="btn btn-lg btn-primary d-flex btn-add" data-bs-toggle="modal" data-bs-target="#create-risk">
              <i data-feather="plus" class="me-2"></i>
              Tambah Detail Risiko
            </button>
            {{-- <button type="button" class="btn btn-warning" data-bs-target="#import" data-bs-toggle="modal">Import</button> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="table-risiko">
                <thead>
                  <tr>
                    <th>Id Risk</th>
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
                  @foreach($headers->risk_detail as $d)
                  <tr>
                    <td>{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->no_urut }}</td>
                    <td>{{ $d->sumber_risiko->konteks->konteks }}</td>
                    <td>{{ $d->sumber_risiko->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ number_format($d->l_awal, 2) + 0 }}</td>
                    <td>{{ number_format($d->c_awal, 2) + 0 }}</td>
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
                      {{ number_format($d->r_awal, 2) + 0 }}
                      </span>
                    </td>
                    <td align="center">
                      @if(count($d->pengajuan_mitigasi) === 1)
                      <span>Aksi Mitigasi telah diajukan</span>
                      @else
                        @if($d->r_awal >= 12)
                          <span class="badge badge-primary">Ajukan Mitigasi</span>
                        {{-- <button class="btn btn-sm btn-pill btn-success" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Tidak Perlu Mitigasi
                        </button> --}}
                        @elseif($d->r_awal < 12)
                          <span class="badge badge-success">Aman</span>
                          {{-- <button class="btn btn-sm btn-pill btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Ajukan Mitigasi
                          </button> --}}
                        @endif
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-secondary btn-detail" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#detail-risk-{{ $d->id_riskd }}">
                        <i data-feather="search" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#edit-risk-{{ $d->id_riskd }}">
                        <i data-feather="edit-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#delete-risk-{{ $d->id_riskd }}">
                        <i data-feather="trash-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                        <i data-feather="info" class="small-icon"></i>
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
<div class="modal fade" id="insert-lampiran" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Input Lampiran Risiko</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('risk-officer.risiko.upload-lampiran') }}" enctype="multipart/form-data">
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
<div class="modal fade" id="create-risk" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form action="{{ route('risk-officer.risk-detail.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_riskh" value="{{ $headers->id_riskh }}">
            <input type="hidden" name="tahun" value="{{ $headers->tahun }}">
            <input type="hidden" name="company_id" value="{{ $headers->company_id }}">
            <input type="hidden" name="status_mitigasi" value="0">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Identifikasi</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Sasaran Kinerja</label>
                    <!-- <textarea class="form-control" name="sasaran_kinerja" placeholder="Masukkan Sasaran Kinerja" required ></textarea> -->
                    <select class="select2" name="sasaran_kinerja" required>
                      @if(count($sasaran) > 0)
                        @foreach($sasaran as $val)
                          <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group pt-2">
                    <label>Risiko</label>
                    <input type="hidden" name="no_urut" value=""></input>
                    <select class="select2" name="id_s_risiko" required id="select-risiko">
                      @foreach($pilihan_s_risiko as $p)
                      <option value="{{ $p->id_s_risiko }}">{{ $p->tahun }} - {{ $p->s_risiko }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group pt-2">
                    <label>PPKH</label>
                    <textarea class="form-control" name="ppkh" required placeholder="Masukkan Peraturan Perundangan dan Kebutuhan Harapan"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Indikator</label>
                    <textarea class="form-control" name="indikator" required placeholder="Masukkan Indikator"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Sebab</label>
                    <textarea class="form-control" name="sebab" required placeholder="Masukkan sebab"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif</label>
                    <input type="text" id="idr_kuantitatif" required class="form-control" name="dampak_kuantitatif" placeholder="Masukkan nominal">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko</label>
                    <textarea class="form-control" required name="dampak" placeholder="Masukkan dampak"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>UC / C</label>
                    <select class="form-control" required name="uc">
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
                    <textarea class="form-control" required name="pengendalian" placeholder="Masukkan pengendalian"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Penilaian</label>
                    <textarea class="form-control" required name="penilaian" placeholder="Masukkan penilaian"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>L</label>
                    <input type="number" required class="form-control" onkeyup="cal()" name="l_awal" id="l_awal" placeholder="Nilai L" value="{{ number_format($nilai_l, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" required class="form-control" onkeyup="cal()" name="c_awal" id="c_awal" placeholder="Nilai C" value="{{ number_format($nilai_c, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" required class="form-control" name="r_awal" id="r_awal" placeholder="Nilai R" readonly value="{{ number_format($nilai_l * $nilai_c, 2) + 0 }}">
                  </div>
                </div>
              </div>
              <div class="row pt-5">
                <div class="col-md-6">
                  <h6>Peluang</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Peluang</label>
                    <textarea class="form-control" required name="peluang" placeholder="Masukkan peluang"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <h6>Penanganan</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Rencana Tindak Lanjut</label>
                    <textarea class="form-control" required name="tindak_lanjut" placeholder="Masukkan rencana tindak lanjut"></textarea>
                  </div>
                  <!-- <div class="form-group pt-2">
                    <label>Jadwal Pelaksanaan</label> -->
                    <!-- <input type="date" class="form-control" name="jadwal" > -->

                    <!-- <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">Jadwal Pelaksanaan</label> -->
                      <!-- <div class="col-sm-9"> -->
                        <!-- <div class="date-picker">
                          <input class="datepicker-here form-control digits" required type="text" placeholder="Pilih Tanggal" data-language="en" name="jadwal">
                        </div> -->
                      <!-- </div> -->
                  <!-- </div> -->
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif Residual</label>
                    <input type="text" id="idr_kuantitatif_residu" required class="form-control" name="dampak_kuantitatif_residu" placeholder="Masukkan nominal">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko Residual</label>
                    <textarea class="form-control" required name="dampak_residu" placeholder="Masukkan dampak"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>PIC</label>
                    <textarea class="form-control" required name="pic" placeholder="Masukkan PIC divisi"></textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>Dokumen Terkait</label>
                    <textarea class="form-control" required name="dokumen" placeholder="Masukkan dokumen terkait"></textarea>
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

@foreach($headers->risk_detail as $data)
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
                    <textarea class="form-control" name="ppkh" placeholder="Masukkan Peraturan Perundangan dan Kebutuhan Harapan" readonly>{{ $data->ppkh }}</textarea>
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
                    <input type="number" class="form-control" onkeyup="calEdit({{ $d->id_riskd }})" name="l_awal" id="l_awal_{{ $d->id_riskd }}" placeholder="Nilai L" value="{{ number_format($data->l_awal, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" class="form-control" onkeyup="calEdit({{ $d->id_riskd }})" name="c_awal" id="c_awal_{{ $d->id_riskd }}" placeholder="Nilai C" value="{{ number_format($data->c_awal, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" class="form-control" name="r_awal" id="r_awal_{{ $d->id_riskd }}" placeholder="Nilai R" readonly value="{{ number_format($data->r_awal, 2) + 0 }}">
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
                    <input type="text" class="form-control" name="jadwal" placeholder="Pilih Tanggal" value="@if($data->jadwal === null) - @else {{ date('d M Y', strtotime($data->jadwal)) }} @endif" readonly>
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
                    <textarea class="form-control" name="pic" readonly>{{ $data->pic }}</textarea>
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
<div class="modal fade" id="edit-risk-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Risk Detail</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form action="{{ route('risk-officer.risk-detail.update', $data->id_riskd) }}" method="POST">
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
                    <select class="select2" name="sasaran_kinerja" required>
                      @if(count($sasaran) > 0)
                        @foreach($sasaran as $val)
                          <option value="{{ $val }}" @if($data->sasaran_kinerja == $val) selected @endif>{{ $val }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group pt-2">
                    <label>Risiko</label>
                    <select id="select-risk-edit-{{ $data->id_riskd }}" class="select2" name="id_s_risiko" required>
                    </select>
                  </div>
                  <div class="form-group pt-2">
                    <label>PPKH</label>
                    <textarea class="form-control" name="ppkh" placeholder="Masukkan Peraturan Perundangan dan Kebutuhan Harapan">{{ $data->ppkh }}</textarea>
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
                    <input type="text" id="idr_kuantitatif_edit_{{ $data->id_riskd }}" onkeyup="idr_kuantitatif_to_currency()" name="dampak_kuantitatif" class="form-control" value="{{ $data->dampak_kuantitatif }}">
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
                    <input type="number" class="form-control" onkeyup="calEdit({{ $d->id_riskd }})" name="l_awal" id="l_awal_{{ $d->id_riskd }}" placeholder="Nilai L" value="{{ number_format($data->l_awal, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" class="form-control" onkeyup="calEdit({{ $d->id_riskd }})" name="c_awal" id="c_awal_{{ $d->id_riskd }}" placeholder="Nilai C" value="{{ number_format($data->c_awal, 2) + 0 }}" readonly>
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" class="form-control" name="r_awal" id="r_awal_{{ $d->id_riskd }}" placeholder="Nilai R" readonly value="{{ number_format($data->r_awal, 2) + 0 }}">
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
                    <div class="date-picker">
                          <input class="datepicker-here form-control digits" type="text" placeholder="Pilih Tanggal" value="{{ $data->jadwal }}" data-language="en" name="jadwal">
                        </div>
                  </div>
                  <div class="form-group pt-2">
                    <label>IDR Kuantitatif Residual</label>
                    <input type="text" id="idr_kuantitatif_residu_edit_{{ $data->id_riskd }}" onkeyup="idr_kuantitatif_residu_to_currency()" class="form-control" value="{{ $data->dampak_kuantitatif_residu }}" name="dampak_kuantitatif_residu">
                  </div>
                  <div class="form-group pt-2">
                    <label>Dampak Risiko Residual</label>
                    <textarea class="form-control" name="dampak_residu">{{ $data->dampak_residu }}</textarea>
                  </div>
                  <div class="form-group pt-2">
                    <label>PIC</label>
                    <textarea class="form-control" name="pic">{{ $data->pic }}</textarea>
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
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
    $("#table-risiko").DataTable({
      'order': [ 1, 'asc' ]
    });
    $("#select-risiko").on('change', function(){
      $.post(
        "{{ url('risk-officer/fetchNilaiRisiko') }}", {
          _token: "{{ csrf_token() }}",
          id: $(this).val()
        }, function(result) {
          console.log(result)
          $("#l_awal").val(parseFloat(result.nilai_l).toFixed(2))
          $("#c_awal").val(parseFloat(result.nilai_c).toFixed(2))
          var mul = parseFloat(result.nilai_l) * parseFloat(result.nilai_c);
          $('#r_awal').val(mul.toFixed(2));
        }
      )
    });

    $(".btn-edit").on('click', function(){
      var id_risk = $(this).attr("data-id");
      console.log("id_risk :" + id_risk);
      $.post(
          "{{ url('risk-officer/getRisikoSelected') }}", {
            _token: "{{ csrf_token() }}",
            id:  id_risk
          }, function(result) {
            console.log(result);
            // console.log("cek 1 : "+result.all_s_risiko[0].id_s_risiko);
            // console.log("cek select awal : "+  $("#select-risk-edit-"+id_risk).val());
            $('#select-risk-edit-'+id_risk).empty();
            for(var i = 0; i<result.all_s_risiko.length; i++){
              // console.log("allrisk : "+result.all_s_risiko[i].id_s_risiko);
              // console.log("selected : "+result.s_risk_selected )
              var is_selected = false;
              if(result.all_s_risiko[i].id_s_risiko == result.s_risk_selected ){
                is_selected = true;
              }
              // console.log("pilihan_s_risk : "+result.pilihan_s_risiko[i].id_s_risiko );
              // console.log("selected : "+result.s_risk_selected )
              // for(var j = 0; j<result.pilihan_s_risiko.length; j++){
              //   if(result.all_s_risiko[i].id_s_risiko != result.pilihan_s_risiko[j].id_s_risiko || result.all_s_risiko[i].id_s_risiko == result.s_risk_selected ){
              //     var text = result.all_s_risiko[i].tahun+" - "+ result.all_s_risiko[i].s_risiko;
              //     var option = new Option(text, result.all_s_risiko[i].id_s_risiko, false, is_selected);
              //   }
              // }
              var cekInclude = result.pilihan_s_risiko.includes(result.all_s_risiko[i].id_s_risiko);
              if ( cekInclude == false || result.all_s_risiko[i].id_s_risiko == result.s_risk_selected ) {
                var text = result.all_s_risiko[i].tahun+" - "+ result.all_s_risiko[i].s_risiko;
                var option = new Option(text, result.all_s_risiko[i].id_s_risiko, false, is_selected);
                $('#select-risk-edit-'+id_risk).append(option).trigger("change");
              }


					  }
            // console.log(result.pilihan_s_risiko[4].id_s_risiko);
            // console.log(result.all_s_risiko[0].id_s_risiko);
            // console.log("cek select akhir : "+  $("#select-risk-edit-"+id_risk).val());

            // console.log("pilihan_s_risk : "+result.pilihan_s_risiko[0].id_s_risiko );
            // console.log("allrisk : "+result.all_s_risiko[5].id_s_risiko);
          }
        )
        window.id_risk = id_risk
    });

  })

  // format rupiah uang idr kuantitatif
    var idr = document.getElementById("idr_kuantitatif");
    idr.addEventListener("keyup", function(e) {
      idr.value = convertRupiah(this.value, "");
    });

    var idr_residu = document.getElementById("idr_kuantitatif_residu");
    idr_residu.addEventListener("keyup", function(e) {
      idr_residu.value = convertRupiah(this.value, "");
    });

    // var idr_edit = document.getElementById("idr_kuantitatif_edit");
    // idr_edit.addEventListener("keyup", function(e) {
    //   // console.log("masuk js");
    //   idr_edit.value = convertRupiah(this.value, "");
    // });

    // var idr_residu_edit = document.getElementById("idr_kuantitatif_residu_edit");
    // idr_residu_edit.addEventListener("keyup", function(e) {
    //   idr_residu_edit.value = convertRupiah(this.value, "");
    // });
    window.id_risk = null
    function idr_kuantitatif_to_currency(){
        var idr_edit = document.getElementById("idr_kuantitatif_edit_"+window.id_risk)
        // console.log("idr edit : "+idr_edit);
        idr_edit.value = convertRupiah(idr_edit.value, '')
    }
    function idr_kuantitatif_residu_to_currency(){
        var idr_edit = document.getElementById("idr_kuantitatif_residu_edit_"+window.id_risk)
        idr_edit.value = convertRupiah(idr_edit.value, '')
    }

    
  function convertRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? rupiah : "";
  }

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
