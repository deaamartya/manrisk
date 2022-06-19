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
            <button class="btn btn-lg btn-primary d-flex btn-add" data-bs-toggle="modal" data-bs-target="#create-header">
              <i data-feather="plus" class="me-2"></i>
              Tambah Risiko Header
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tahun</th>
                    <th>Target</th>
                    <th>Penyusun</th>
                    <th>Pemeriksa</th>
                    <th>Jml</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($headers as $d)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{!! nl2br($d->target) !!}</td>
                    <td>{{ ($d->penyusun ? $d->penyusun->name : '-') }}</td>
                    <td>{{ ($d->pemeriksa ? $d->pemeriksa->name : '-') }}</td>
                    <td>
                      <button class="btn btn-pill btn-success">
                        {{ count($d->risk_detail) }}
                      </button>
                    </td>
                    <td>
                      <a href="{{ route('risk-officer.risiko.show', $d->id_riskh) }}" class="btn btn-sm btn-primary d-flex align-items-center">
                        <i data-feather="eye" class="me-2 small-icon"></i>
                        Detail
                      </a>
                    </td>
                    <td>
                      <a href="{{ route('risk-officer.risiko.print', $d->id_riskh) }}" target="_blank" class="btn btn-sm btn-success">
                        <i data-feather="printer" class="small-icon"></i>
                      </a>
                      <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $d->id_riskh }}" data-bs-toggle="modal" data-bs-target="#edit-header-{{ $d->id_riskh }}">
                        <i data-feather="edit-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $d->id_riskh }}" data-bs-toggle="modal" data-bs-target="#delete-header-{{ $d->id_riskh }}">
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
<div class="modal fade" id="create-header" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Input Header Risk</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('risk-officer.risiko.store') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
							<div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Tahun</label>
									<div class="col-sm-9">
                    <select class="form-select" name="tahun">
                      @for($i=0;$i<10;$i++)
                      @php $tahun = intval(date('Y') - 5 + $i) @endphp
                      <option value="{{ $tahun }}" @if($tahun == date('Y')) selected @endif>
                        {{ $tahun }}
                      </option>
                      @endfor
                    </select>
									</div>
								</div>
              </div>
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Target</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="target"></textarea>
									</div>
								</div>
              </div>
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Penyusun</label>
									<div class="col-sm-9">
                    <input type="text" class="form-control" name="penyusun" value="{{ Auth::user()->name }}" readonly/>
                    <input type="hidden" class="form-control" name="id_penyusun" value="{{ Auth::user()->id_user }}"/>
									</div>
								</div>
              </div>
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Pemeriksa</label>
									<div class="col-sm-9">
                    <input type="text" class="form-control" name="pemeriksa" value="{{ ($risk_owner ? $risk_owner->name : null) }}" readonly/>
                    <input type="hidden" class="form-control" name="id_pemeriksa" value="{{ ($risk_owner ? $risk_owner->id_user : null) }}"/>
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
@foreach($headers as $data)
<div class="modal fade" id="edit-header-{{ $data->id_riskh }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Risk Header</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('risk-officer.risiko.update', $data->id_riskh) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="modal-body">
            <div class="row">
							<div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Tahun</label>
									<div class="col-sm-9">
                    <select class="select2" name="tahun" id="edit-tahun-header">
                      @for($i=0;$i<10;$i++)
                      @php $tahun = intval(date('Y') - 5 + $i) @endphp
                      <option value="{{ $tahun }}" @if($data->tahun == $tahun) selected @endif>
                        {{ $tahun }}
                      </option>
                      @endfor
                    </select>
									</div>
								</div>
              </div>
              <div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Target</label>
									<div class="col-sm-9">
                    <textarea class="form-control" name="target">{{ $data->target }}</textarea>
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
<div class="modal fade" id="delete-header-{{ $data->id_riskh }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Risk Header</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('risk-officer.risiko.destroy',  $data->id_riskh) }}" method="POST">
          @method('DELETE')
          @csrf
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus risk header dengan target : </p>
            {!! nl2br($d->target) !!}
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Hapus</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
    const headers = @json($headers);
    $(".select2").select2();
  })
</script>
@endsection
