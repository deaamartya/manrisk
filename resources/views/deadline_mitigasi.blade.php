@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}"> --}}
@endsection

@section('page-title')
<h3>Deadline Mitigasi</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Deadline Mitigasi</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="table-risiko">
                <thead>
                  <tr>
                    <th>Id Risk</th>
                    <th>Risiko</th>
                    <th>Perusahaan</th>
                    <th>Tahun</th>
                    {{-- <th>L Awal</th>
                    <th>C Awal</th>
                    <th>R Awal</th>
                    <th>L Akhir</th>
                    <th>C Akhir</th>
                    <th>R Akhir</th> --}}
                    <th>Mitigasi</th>
                    <th>Jadwal Pelaksanaan</th>
                    <th>% Realisasi</th>
                    {{-- <th>Keterangan</th> --}}
                    {{-- <th>Dokumen</th> --}}
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $d)
                  <tr>
                    <td>{{ $d->id_risk .'-'. $d->no_k }}</td>
                    <td>{{ $d->s_risiko }}</td>
                    <td>{{ $d->instansi }}</td>
                    <td>{{ $d->tahun }}</td>
                    {{-- <td>{{ number_format($d->l_awal, 2) + 0 }}</td>
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
                    <td>{{ number_format($d->l_akhir, 2) + 0 }}</td>
                    <td>{{ number_format($d->c_akhir, 2) + 0 }}</td>
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
                      {{ number_format($d->r_akhir, 2) + 0 }}
                      </span>
                    </td> --}}
                    <td>
                      @if($d->mitigasi === null) -
                      @else {{ $d->mitigasi }}
                      @endif
                    </td>
                    <td>
                      @if($d->jadwal_mitigasi === null) -
                      @else {{ date('d M Y', strtotime($d->jadwal_mitigasi)) }}
                      @endif
                    </td>
                    <td>
                      @if($d->final_realisasi === null) -
                      @else {{ $d->final_realisasi ?? $d->realisasi }}%
                      @endif
                    </td>
                    {{-- <td>{{ $d->keterangan }}</td> --}}
                    {{-- <td>
                      @if($d->u_file)
                      <button class="btn btn-xs btn-primary p-1 flex-center open-btn" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#add-progress-{{ $d->id_riskd }}">
                        <i data-feather="plus" class="small-icon" height="13"></i>Progress
                      </button>
                      @endif
                    </td>
                    <td>
                      @if(auth()->user()->is_admin == 1)
                        <a href="{{ url('admin/approval-mitigasi/'.$d->id_riskd) }}"><button class="btn btn-xs btn-info p-1 flex-center">
                          <i data-feather="edit" class="small-icon" height="13"></i>
                        </button></a>
                      @else
                        <button class="btn btn-xs btn-info p-1 flex-center" data-id="{{ $d->id_riskd }}" data-bs-toggle="modal" data-bs-target="#edit-mitigasi-{{ $d->id_riskd }}">
                          <i data-feather="edit" class="small-icon" height="13"></i>
                        </button>
                      @endif
                    </td> --}}
                    @if (auth()->user()->is_admin)
                    <td>
                        <a href="{{ route('admin.approval-hasil-mitigasi.show', $d->id_riskh) }}"><i class="fa fa-external-link"></i></a>
                    </td>
                    @elseif (auth()->user()->is_risk_officer)
                    <td>
                        <a href="{{ route('risk-officer.mitigasi-plan.show', $d->id_riskh) }}"><i class="fa fa-external-link"></i></a>
                    </td>
                    @endif
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

{{-- Untuk Sementara Tidak Dipakai --}}
{{-- @foreach($headers->risk_detail as $data)
<div class="modal fade" id="edit-mitigasi-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Input Data Mitigasi</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.mitigasi-plan.update', $data->id_riskd) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">ID Risk</label>
									<div class="col-sm-9">
                    <input class="form-control" name="id_riskd" required readonly value="{{ $data->id_riskd }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Level Risiko Awal</label>
									<div class="col-sm-9">
                    <input class="form-control" name="r_awal" required readonly value="{{ $data->r_awal }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Risiko</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="risiko" required readonly>{{ $data->sumber_risiko->s_risiko }}</textarea>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Mitigasi</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="mitigasi" required>{{ $data->mitigasi }}</textarea>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Jadwal Pelaksanaan</label>
									<div class="col-sm-9">
                    <div class="date-picker">
                      <input class="datepicker-here form-control digits" type="text" data-language="en" name="jadwal_mitigasi" value="{{ date('Y-m-d', strtotime($data->jadwal_mitigasi)) }}">
                    </div>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Keterangan</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="keterangan" required>{{ $data->keterangan }}</textarea>
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">L</label>
									<div class="col-sm-9">
                    <input type="number" class="form-control" onkeyup="cal({{ $data->id_riskd }})" id="l_akhir_{{ $data->id_riskd }}" name="l_akhir" required value="{{ $data->l_akhir }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">C</label>
									<div class="col-sm-9">
                    <input type="number" class="form-control" onkeyup="cal({{ $data->id_riskd }})" id="c_akhir_{{ $data->id_riskd }}" name="c_akhir" required value="{{ $data->c_akhir }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">R</label>
									<div class="col-sm-9">
                    <input type="number" class="form-control" onkeyup="cal({{ $data->id_riskd }})" id="r_akhir_{{ $data->id_riskd }}" name="r_akhir" required value="{{ $data->r_akhir }}">
									</div>
								</div>
                <div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Upload File</label>
									<div class="col-sm-9">
                    <input type="file" class="form-control" name="u_file">
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
<div class="modal fade" id="add-progress-{{ $data->id_riskd }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Progress</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <form method="POST" action="{{ route('admin.storeProgress') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_riskd" value="{{ $data->id_riskd }}"/>
                <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}"/>
                <div class="mb-3 row">
                  <div class="col-sm-6">
                    <h6>Tambah Progress Baru</h6>
                  </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Prosentase</label>
                    <div class="col-sm-9">
                      <select name="prosentase" class="form-control" required>
                          <option value="25">25 %</option>
                          <option value="50">50 %</option>
                          <option value="75">75 %</option>
                          <option value="100">100 %</option>
                      </select>
                    </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Dokumen</label>
                  <div class="col-sm-9">
                    <input type="file" name="dokumen" class="form-control" required />
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                    <textarea name="description" class="form-control"></textarea>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-3 text-end">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table-datatable" id="table-progress-{{ $data->id_riskd }}">
              <thead>
                <th>No</th>
                <th>Prosentase</th>
                <th>Dokumen</th>
                <th>Description</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>
@endforeach --}}
@endsection
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/summernote/summernote.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script> --}}
<script>
  $(document).ready(function(){
    // $(".select2").select2();
    $("#table-risiko").DataTable({
        columnDefs: [
            { orderable: false, targets: 7 }
        ],
        'order': [ 4, 'desc' ]
    });
    // var table;
    // $(document).on('click', '.open-btn', function(){
    //   const id = $(this).attr('data-id')
    //   const url = "{{ url('admin/getProgress') }}";
    //   table = $("#table-progress-"+id).DataTable({
    //     "destroy": true,
    //     "ajax": {
    //       "url": url,
    //       "type": "post",
    //       "data": {
    //         "_token": "{{ csrf_token() }}",
    //         "id": id
    //       }
    //     }
    //   })
    // })
  })
//   function cal(id) {
//     var lawal = $('#l_akhir_'+id).val();
//     var cawal = $('#c_akhir_'+id).val();
//     var mul = lawal * cawal;
//     $('#r_akhir_'+id).val(mul);
//   }
</script>
@endsection
