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
          <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tahun</th>
                    <th>Target</th>
                    <th>Penyusun</th>
                    <th>Pemeriksa</th>
                    <th>Jml</th>
                    <th>Status</th>
                    <th>Approval</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($headers as $d)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{!! nl2br($d->target) !!}</td>
                    <td>{{ $d->penyusun }}</td>
                    <td>{{ $d->pemeriksa }}</td>
                    <td>
                      <button class="btn btn-pill btn-success">
                        {{ count($d->risk_detail) }}
                      </button>
                    </td>
                    <td>
                      <a href="{{ route('risk-owner.risiko.show', $d->id_riskh) }}">
                        <button class="btn btn-sm btn-primary d-flex align-items-center">
                          <i data-feather="eye" class="me-2 small-icon"></i>Detail
                        </button>
                      </a>
                    </td>
                    <td>
                      @if($d->status_h === 0)
                      <button class="btn btn-sm btn-green d-flex align-items-center" data-bs-target="#approval-{{ $d->id_riskh }}" data-bs-toggle="modal">
                        <i data-feather="check-square" class="small-icon"></i>
                      </button>
                      @elseif($d->status_h === 1)
                      <span class="text-success">Disetujui</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('risk-owner.risiko.print', $d->id_riskh) }}" target="_blank" class="btn btn-sm btn-success">
                        <i data-feather="printer" class="small-icon"></i>
                      </a>
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
@foreach($headers as $d)
<div class="modal fade" id="approval-{{ $d->id_riskh }}" tabindex="-1" role="dialog" aria-labelledby="insertResponden" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Approval Risk Header</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="GET" action="{{ route('risk-owner.risiko.approve', $d->id_riskh) }}">
        <div class="modal-body">
          @csrf
          Apakah Anda yakin menyetujui risk header tahun {{ $d->tahun }} dengan target :
          <br>
          {!! nl2br($d->target) !!}
        </div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">Tidak</button>
          <button class="btn btn-primary" type="submit">Ya, saya yakin</button>
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
    const headers = @json($headers);
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
    $('.btn-edit').on('click', function() {
      const id = $(this).attr('data-id');
      $('#summernote-' + id).summernote({
        toolbar: [
          ['para', ['ul', 'ol']],
        ],
        height: 300,
        tabsize: 2,
        callbacks: {
          onChange: function(contents, $editable) {
            $("#summernote-value-" + id).val($editable[0].innerHTML);
          }
        }
      });
    });
  })
</script>
@endsection