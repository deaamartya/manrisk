@extends('layouts.user.table')
@section('title', 'Mitigasi Plan')

@section('breadcrumb-title')
<h3>Mitigasi Plan</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Mitigasi Plan</li>
@endsection

@section('content')
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
                  <th>No</th>
                  <th>Tahun</th>
                  <th>Tanggal</th>
                  <th>Target</th>
                  <th>Total Mitigasi</th>
                  <th>Selesai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($headers as $h)
                <tr>
                  <td>{{ $loop->index }}</td>
                  <td>{{ $h->tahun }}</td>
                  <td>{{ $h->created_at }}</td>
                  <td>{!! $h->target !!}</td>
                  <td>
                    <div class="alert alert-success">1</div>
                  </td>
                  <td>
                    <div class="alert alert-success">0</div>
                  </td>
                  <td>
                    <button class="btn btn-info">
                      <i class="fa fa-eye"></i> View
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
@endsection
