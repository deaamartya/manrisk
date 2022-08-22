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
                  <th>Instansi</th>
                  <th>Tahun</th>
                  <th>Tanggal</th>
                  <th>Target</th>
                  <th>Total Mitigasi</th>
                  <th>Selesai</th>
                  @if(auth()->user()->is_admin == 1)
                    <th>Perlu Approve</th>
                  @endif
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($headers as $h)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $h->perusahaan->instansi }}</td>
                  <td>{{ $h->tahun }}</td>
                  <td>{{ date('d M Y', strtotime($h->tanggal)) }}</td>
                  <td>{!! nl2br($h->target) !!}</td>
                  <td class="text-center">
                    <div class="btn btn-primary btn-pill btn-xs status">{{ $h->migrateCount($h->id_riskh) }}</div>
                  </td>
                  <td>
                    <div class="btn btn-info btn-pill btn-xs status">{{ $h->doneMigrateCount($h->id_riskh) }}</div>
                  </td>
                  @if (auth()->user()->is_admin == 1)
                  <td class="text-center">
                    @if ($h->getMitigasiNeedApprove()->need_approve > 0)
                        <div class="btn btn-warning btn-pill btn-xs status @php echo ($h->getMitigasiNeedApprove()->need_approve > 1) ? 'blink_badge' : ''; @endphp">
                            {{ $h->getMitigasiNeedApprove()->need_approve }}
                        </div>
                    @else
                        -
                    @endif
                  </td>
                  @endif
                  <td>
                    <a href="{{ auth()->user()->is_admin ? route('admin.approval-hasil-mitigasi.show', $h->id_riskh) : route('risk-officer.mitigasi-plan.show', $h->id_riskh) }}" class="btn btn-info">
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
