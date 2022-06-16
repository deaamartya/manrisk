@extends('layouts.user.table')
@section('title', 'Approval Hasil Mitigasi')

@section('breadcrumb-title')
<h3>Persetujuan Hasil Mitigasi</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Persetujuan Hasil Mitigasi</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th style="width: 40px">No</th>
                                    <th>Deskripsi</th>
                                    <th>Dokumen</th>
                                    <th>% Realisasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td align="center">
                                        @if(!$d->dokumen)
                                            -
                                        @else
                                        <button class="btn btn-xs btn-primary p-1 flex-center" data-id="{{ $d->id }}" data-bs-toggle="modal" data-bs-target="#preview-document-{{ $d->id }}">
                                            <i data-feather="zoom-in" class="small-icon" height="13"></i>View File
                                        </button>
                                        @endif
                                    </td>
                                    <td align="center" style="width: 60px">
                                        <input type="number" class="realisasi" value="{{ $d->realisasi }}" id="{{ $d->id }}" readonly>
                                    </td>
                                    <td align="center">
                                    @if(!$d->is_approved)
                                        <button class="btn btn-warning btn-sm approve" id="{{ $d->id }}"><i class="feather feather-check-circle"></i> Approval</button>
                                    @endif
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

@foreach ($data as $dt)
<div class="modal fade" id="preview-document-{{ $dt->id }}" tabindex="-1" role="dialog" aria-labelledby="create-header" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Preview Document</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <embed src="{{ asset('document/lampiran-mitigasi/'.$dt->dokumen) }}" width="100%" height="500"/>
          </div>
      </div>
    </div>
  </div>
@endforeach

@endsection

@section('custom-script')
    <script>
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript" src="{{asset('assets/js/custom/approval_hasil_mitigasi.js')}}"></script>
@endsection
