@extends('layouts.user.table')
@section('title', 'Mitigasi Plan Indhan')

@section('breadcrumb-title')
<h3>Mitigasi Plan Indhan</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Mitigasi Plan Indhan</li>
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
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $h->tahun }}</td>
                  <td>{{ date('d M Y', strtotime($h->tanggal)) }}</td>
                  <td>{!! nl2br($h->target) !!}</td>
                  <td class="text-center">
                    <div class="btn btn-primary btn-pill btn-xs status">{{ $h->migrateCount($h->id_riskh) }}</div>
                  </td>
                  <td>
                    <div class="btn btn-info btn-pill btn-xs status">{{ $h->doneMigrateCount($h->id_riskh) }}</div>
                  </td>
                  <td>
                    <a href="{{ route('admin.mitigasi-plan-indhan.show', $h->id_riskh) }}" class="btn btn-info">
                      <i class="fa fa-eye"></i> View
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
@endsection
