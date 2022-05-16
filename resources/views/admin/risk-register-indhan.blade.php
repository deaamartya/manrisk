@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
@endsection

@section('page-title')
<h3>Risk Register INDHAN</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Risk Register INDHAN</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <form action="{{ route('admin.search-risk-header') }}" method="GET">
              @csrf
                <div class="row">
                  <div class="col-md-3">
                    <label>Filter Berdasarkan Tahun</label>
                  </div>
                  <div class="col-md-3">
                    <select class="select2" name="tahun" required>
                      <option disabled selected>Pilih Tahun</option>
                      @foreach($tahun as $t)
                        <option value="{{ $t->tahun }}" @if($tahun_filter != null && $t->tahun == $tahun_filter) selected @endif>{{ $t->tahun }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    <button class="col-md-6 btn btn-sm btn-primary" style="width: 100%;">
                      <i class="fa fa-search"></i>
                      Cari
                    </button>
                  </div>
                  <div class="col-md-3 text-center">
                    <a href="{{ route('admin.all-risk-header') }}" class="col-md-6 btn btn-sm btn-success" style="width: 100%;">
                      <i class="fa fa-list"></i>
                      Semua data
                    </a>
                  </div>
                </div>
            </form>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tahun</th>
                    <th>Instansi</th>
                    <th>Tanggal</th>
                    <th>Target</th>
                    <th>Penyusun</th>
                    <th>Pemeriksa</th>
                    <th>Jml</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @if($data_headers != null)
                  @foreach($data_headers as $d)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{{ $d->instansi }}</td>
                    <td>{{ date('d M Y (H:i)', strtotime($d->tanggal))  }}</td>
                    <td>{{ $d->target }}</td>
                    <td>{{ $d->penyusun }}</td>
                    <td>{{ $d->pemeriksa }}</td>
                    <td>{{ count($d->risk_detail) }}</td>
                    <td>
                      <a href="{{ route('admin.detail-risk-register', $d->id_riskh) }}" class="btn btn-sm btn-primary d-flex align-items-center">
                        <i data-feather="eye" class="me-2 small-icon"></i> Detail
                      </a>
                      <a href="{{ route('admin.print-risk-register', $d->id_riskh) }}" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
                        <i data-feather="printer" class="me-2 small-icon"></i> Print
                      </a>
                      <a href="{{ route('admin.approval-risk-register', $d->id_riskh) }}" class="btn btn-sm btn-warning d-flex align-items-center">
                        <i data-feather="check-circle" class="me-2 small-icon"></i> Approval
                      </a>
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
@endsection
@section('custom-script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/summernote/summernote.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".select2").select2();
    $('#summernote').summernote({
      toolbar: [
        ['para', ['ul', 'ol']],
      ],
      height: 300,
      tabsize: 2,
      callbacks: {
        onChange: function(contents, $editable) {
          $("#summernote-value").val($editable[0].innerHTML);
        }
      }
    });
  })
</script>
@endsection