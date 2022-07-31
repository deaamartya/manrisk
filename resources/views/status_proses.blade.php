@extends('layouts.user.table')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/summernote.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}"> --}}
@endsection

@section('page-title')
<h3>Status Proses Terkini</h3>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Status Proses Terkini</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
            @if(Auth::user()->is_risk_officer)
            <div class="card-header">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahStatusProses"><i class="fa fa-plus"></i> Tambah Status Proses</button>
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                <table class="display" id="table-risiko">
                    <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Proses</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($status_proses as $s)
                    <tr>
                        <td>{{ $s->tahun }}</td>
                        <td>{{ $s->proses_manrisk->nama_proses }}</td>
                        <td>
                            <div class="flex" style="justify-content: center;">
                                <button class="btn btn-warning btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#edit_{{ $s->id_status_proses }}"><i class="fa fa-pencil"></i> Edit Status</button>
                            </div>
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

<div class="modal fade" id="tambahStatusProses" role="dialog" aria-labelledby="tambahStatusProses" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Status Proses Terkini</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{ route('status-proses.store') }}">
                    @csrf    
                    <div class="row mb-3">
                        <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Tahun <span class="required"></span></label>
                        <div class='col-md-9 col-sm-9 col-xs-12'>
                            <select class="form-select" name="tahun" required>
                            <?php
                                $tahun = date("Y");
                                $bts_tahun = $tahun + 4;
                                for ($i=$tahun; $i <= $bts_tahun ; $i++) { 
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 col-sm-3 col-xs-12">Proses Terkini</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="js-example-basic-single col-sm-12" name="id_proses" required>
                                @foreach($proses as $p)
                                <option value="{{ $p->id_proses }}">
                                    {{ $p->nama_proses }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@foreach($status_proses as $s)
    <div class="modal fade" id="edit_{{ $s->id_status_proses}}" role="dialog" aria-labelledby="editStatusProses" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Status Proses Terkini</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{route('status-proses.update', $s->id_status_proses) }}">
                    @method('PUT')
                    @csrf    
                    <div class="row mb-3">
                        <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Tahun <span class="required"></span></label>
                        <div class='col-md-9 col-sm-9 col-xs-12'>
                            <input type="text" name="tahun" class="form-control" value="{{ $s->tahun }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-3 col-sm-3 col-xs-12">Proses Terkini</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="js-example-basic-single col-sm-12" name="id_proses" required>
                                @foreach($proses as $p)
                                <option value="{{ $p->id_proses }}" @if($s->id_proses == $p->id_proses) selected @endif>
                                    {{ $p->nama_proses }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
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
{{-- <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script> --}}
<script>
  $(document).ready(function(){
    // $(".select2").select2();
    $("#table-risiko").DataTable({
      'order': [ 0, 'desc' ]
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
