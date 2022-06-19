@extends('layouts.user.table')
@section('title', 'Data Master | User')

@section('breadcrumb-title')
<h3>User</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">User</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" type="button" id="tambah_user"><i class="fa fa-plus"></i> Tambah User</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Perusahaan</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $u)
                                @php
                                    $role = [];
                                    if($u->is_admin){
                                        $role[] = 'Admin';
                                    }
                                    if($u->is_risk_officer){
                                        $role[] = 'Risk Officer';
                                    }
                                    if($u->is_risk_owner){
                                        $role[] = 'Risk Owner';
                                    }
                                    if($u->is_penilai){
                                        $role[] = 'Penilai';
                                    }
                                    if($u->is_penilai_indhan){
                                        $role[] = 'Penilai Indhan';
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $u->instansi }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->jabatan }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>
                                        @foreach ($role as $index => $r)
                                            @if($index == 0)
                                                {{ $r }}
                                            @else
                                                , {{ $r }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center field-status" id="{{ $u->id_user }}">
                                        @if($u->status_user == 1)
                                            <button class="btn btn-primary btn-xs status" type="button" id="status_{{ $u->id_user }}">Tidak Aktif</button>
                                        @else
                                            <button class="btn btn-info btn-xs status" type="button" id="status_{{ $u->id_user }}">Aktif</button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <button class="btn btn-warning btn-xs edit" type="button" id="edit_{{ $u->id_user }}"><i class="fa fa-pencil"></i></button>
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

<div class="modal fade" id="tambahUser" role="dialog" aria-labelledby="tambahUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="judul_modal"></h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="" id="formUser">
                @csrf
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Nama <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="name" required="required" class="form-control" id="formName">
                    </div>
                </div>
                <div class="row mb-3 nip">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">NIP <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="nip" class="form-control" id="formNip">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Jabatan <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="jabatan" class="form-control" id="formJabatan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12">Perusahaan</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select class="js-example-basic-single col-sm-12" name="company_id" id="formPerusahaan">
                            {{-- @foreach($perusahaan as $p)
                                <option value="{{ $p->company_id }}">{{ $p->company_code }} - {{ $p->instansi }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Username <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="username" required="required" class="form-control" id="formUsername">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Password</label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="password" name="password" class="form-control" id="formPassword">
                        <small style="color: red" id="infoPassword"><i>Kosongkan jika tidak ada perubahan.</i></small>
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Ulangi Password</label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="password" name="ulangi_password" class="form-control" id="formUlangiPassword">
                    </div>
                </div> --}}
                <div class="row is_admin">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip"></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="hidden" name="is_admin">
                        <input type="checkbox" name="is_admin" value="0" id="formIsAdmin">
                        <label for="">Admin</label>
                    </div>
                </div>
                <div class="row is_risk_officer">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip"></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="hidden" name="is_risk_officer">
                        <input type="checkbox" name="is_risk_officer" value="0" id="formIsRiskOfficer">
                        <label for="">Risk Officer</label>
                    </div>
                </div>
                <div class="row is_risk_owner">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip"></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="hidden" name="is_risk_owner">
                        <input type="checkbox" name="is_risk_owner" value="0" id="formIsRiskOwner">
                        <label for="">Risk Owner</label>
                    </div>
                </div>
                <div class="row is_penilai">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip"></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="hidden" name="is_penilai">
                        <input type="checkbox" name="is_penilai" value="0" id="formIsPenilai">
                        <label for="">Penilai Korporasi</label>
                    </div>
                </div>
                <div class="row is_penilai_indhan">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip"></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="hidden" name="is_penilai_indhan">
                        <input type="checkbox" name="is_penilai_indhan" value="0" id="formIsPenilaiIndhan">
                        <label for="">Penilai Indhan</label>
                    </div>
                </div>
                <div class="row melakukan_penilaian">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Melakukan Penilaian?</label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="hidden" name="melakukan_penilaian" id="formMelakukanPenilaianHidden">
                        <input type="checkbox" name="melakukan_penilaian" value="0" id="formMelakukanPenilaian">
                        <label for="">No</label>
                    </div>
                </div>

                {{-- <div class="row mb-3 jabatan">
                    <label class="col-md-3 col-sm-3 col-xs-12" for="noarsip">Jabatan <span class="required"></span></label>
                    <div class='col-md-9 col-sm-9 col-xs-12'>
                        <input type="text" name="jabatan" class="form-control" id="formJabatan">
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="modal_status_user" tabindex="-1" role="dialog" aria-labelledby="modal_status_user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Status User</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="PUT" action="">
                @csrf
                Apakah Anda yakin ingin mengubah status user <b></b> ?
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection

@section('custom-script')
    <script>
        const head_url = 'admin'
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript" src="{{asset('assets/js/custom/data_master_user.js')}}"></script>
@endsection
