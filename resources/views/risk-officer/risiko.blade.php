@extends('layouts.risk-officer.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/simple-mde.css')}}">
@endsection

@section('page-title')
<h3>View All Risk</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">View All Risk</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-lg btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#create-header">
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
                    <td>{!! $d->target !!}</td>
                    <td>{{ $d->penyusun }}</td>
                    <td>{{ $d->pemeriksa }}</td>
                    <td>{{ count($d->risk_detail) }}</td>
                    <td>
                      <button class="btn btn-xs btn-primary d-flex align-items-center">
                        <i data-feather="eye" class="me-2 small-icon"></i>
                        Detail
                      </button>
                    </td>
                    <td>
                      <button class="btn btn-xs btn-success">
                        <i data-feather="printer" class="small-icon"></i>
                      </button>
                      <button class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#edit-header-{{ $d->id_riskh }}">
                        <i data-feather="edit-2" class="small-icon"></i>
                      </button>
                      <button class="btn btn-xs btn-danger">
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
                    <textarea id="editable-create" name="target"></textarea>
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
        <div class="modal-body">
          <form>
            <div class="row">
							<div class="col-12">
								<div class="mb-3 row">
									<label class="col-sm-3 col-form-label">Tahun</label>
									<div class="col-sm-9">
                    <select class="form-select" name="tahun" id="edit-tahun-header">
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
                    <textarea id="editable-edit" name="target">{{ $data->target }}</textarea>
									</div>
								</div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="button">Simpan</button>
        </div>
    </div>
  </div>
</div>
@endforeach
@endsection
@section('custom-script')
<script src="{{asset('assets/js/editor/simple-mde/simplemde.min.js')}}"></script>
<script>
  $(document).ready(function(){
    new SimpleMDE({
      element: $("textarea#editable-create")[0]
    });
    new SimpleMDE({
      element: $("textarea#editable-edit")[0]
    });
  })
</script>
@endsection