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
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <button class="btn btn-lg btn-primary d-flex btn-add" data-bs-toggle="modal" data-bs-target="#create-risk">
              <i data-feather="plus" class="me-2"></i>
              Tambah Detail Risiko
            </button>
          </div>
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
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($headers->risk_detail as $d)
                  <tr>
                    <td>{{ $d->sumber_risiko->konteks->id_risk .'-'. $d->sumber_risiko->konteks->no_k }}</td>
                    <td>{{ $d->sumber_risiko->konteks->konteks }}</td>
                    <td>{{ $d->sumber_risiko->s_risiko }}</td>
                    <td>{{ $d->sebab }}</td>
                    <td>{{ $d->l_awal }}</td>
                    <td>{{ $d->c_awal }}</td>
                    <td>{{ $d->r_awal }}</td>
                    <td>
                      @if(count($d->pengajuan_mitigasi) === 1)
                      <span>Aksi Mitigasi telah diajukan</span>
                      @else
                        @if($d->r_awal >= 12)
                          <button class="btn btn-sm btn-pill btn-success" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Tidak Perlu Mitigasi
                          </button>
                        @elseif($d->r_awal < 12)
                          <button class="btn btn-sm btn-pill btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuan-mitigasi-{{ $d->id_riskd }}">
                            Ajukan Mitigasi
                          </button>
                        @endif
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#edit-risk-{{ $d->id_riskd }}">
                        <i data-feather="edit-2" class="small-icon"></i>
                      </button>
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
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Identifikasi</h6>
                  <hr class="hr-custom">
                  <div class="form-group pt-2">
                    <label>Risiko</label>
                    <select class="select2" name="id_s_risiko" required>
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
                    <label>L</label>
                    <input type="number" class="form-control" onkeyup="cal()" name="l_awal" id="l_awal" placeholder="Nilai L" value="{{ $nilai_l }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" class="form-control" onkeyup="cal()" name="c_awal" id="c_awal" placeholder="Nilai C" value="{{ $nilai_c }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" class="form-control" name="r_awal" id="r_awal" placeholder="Nilai R" readonly value="{{ $nilai_l * $nilai_c }}">
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
                    <input type="text" class="form-control" name="jadwal" placeholder="Jadwal Pelaksanaan"></textarea>
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
                    <label>Risiko</label>
                    <select class="select2" name="id_s_risiko" required>
                      @foreach($pilihan_s_risiko as $p)
                      <option value="{{ $p->id_s_risiko }}"
                        @if ($p->id_s_risiko === $data->id_s_risiko)
                        selected
                        @endif
                      >{{ $p->tahun }} - {{ $p->s_risiko }}</option>
                      @endforeach
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
                    <label>L</label>
                    <input type="number" class="form-control" onkeyup="calEdit({{ $d->id_riskd }})" name="l_awal" id="l_awal_{{ $d->id_riskd }}" placeholder="Nilai L" value="{{ $data->l_awal }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>C</label>
                    <input type="number" class="form-control" onkeyup="calEdit({{ $d->id_riskd }})" name="c_awal" id="c_awal_{{ $d->id_riskd }}" placeholder="Nilai C" value="{{ $data->c_awal }}">
                  </div>
                  <div class="form-group pt-2">
                    <label>R</label>
                    <input type="number" class="form-control" name="r_awal" id="r_awal_{{ $d->id_riskd }}" placeholder="Nilai R" readonly value="{{ $data->r_awal }}">
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
                    <input type="text" class="form-control" name="jadwal" placeholder="Jadwal Pelaksanaan" value="{{ $data->jadwal }}">
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
