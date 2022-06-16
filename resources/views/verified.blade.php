@extends('layouts.authentication.master')
@section('title')
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
<style>
.row-card {
  height: 100vh;
}
.row-card .col-card {
  height: 100%;
  display: flex;
}
.col-card .card {
  margin: auto;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row d-flex justify-content-center row-card">
     <div class="col-sm-12 col-md-9 col-lg-6 p-3 col-card">
       <div class="card">
         <div class="card-body text-center">
            <img src="{{ asset('assets/images/logo/logo_company/logo_inhan.png') }}" style="width:120px;" class="mb-2" />
            <div class="verified-content mb-3">
              <h6>Sistem Informasi Manajemen Risiko</h6>
              <hr>
              <p>menyatakan bahwa dokumen ini <strong>asli</strong> dan telah ditandangani secara elektronik oleh :</p>
              <h5>{{ $signed_by }}</h5>
              <hr>
              <h6>Instansi : </h6><p>{{ $instansi }}</p>
              <h6>Tahun periode : </h6><p>{{ $tahun }}</p>
              <h6>Disusun pada : </h6><p>{{ date('d M Y', strtotime($created_at)) }}</p>
              <h6>Disusun oleh : </h6><p>{{ $penyusun }}</p>
            </div>
            <div class="row justify-content-center">
              <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                <a href="{{ url($url) }}" class="btn btn-primary text-center" target="_blank">
                  View/Download
                </a>
              </div>
            </div>
         </div>
       </div>
     </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script>
  $(document).ready(function() {})
</script>
@endsection