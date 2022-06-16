@extends('layouts.user.table')
@section('title', 'Forum')
@section('style')
    <style>
        .subject {
            font-weight: bold;
            font-size: 120%;
        }
        .card-forum {
            cursor: pointer;
            border-radius: 0px 25px 25px 25px;
        }
        .card-forum:hover {
            background-color: lightgrey;
        }
        .body-form {
            font-size: 110%;
        }
        .body-comment p{
            font-size: 110%;
        }
        .hapus-comment {
            cursor: pointer;
            color: red;
        }
        .forum-action {
            float: right;
        }
        .form-forum .card{
            display: block;
            position: fixed;
            /* top: 0; */
        }
        .body-comment {
            display: none;
        }
    </style>
@endsection

@section('breadcrumb-title')
<h3>Forum</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Forum</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-8">
                @foreach ($data as $dt)
                    <div class="row">
                        <div class="col">
                            @if($dt->id_user == auth()->user()->id_user)
                            <div class="btn-group btn-group-square" role="group" aria-label="Basic example">
                                <button class="btn btn-light edit-forum" id="edit_{{ $dt->id }}" type="button" data-bs-original-title="" title=""><i class="fa fa-pencil" style="cursor: pointer"></i></button>
                                {{-- <button class="btn btn-light display-forum" id="display_{{ $dt->id }}" type="button" data-bs-original-title="" title=""><i class="fa fa-eye-slash" style="cursor: pointer"></i></button> --}}
                                <button class="btn btn-light delete-forum" id="delete_{{ $dt->id }}" type="button" data-bs-original-title="" title=""><i class="fa fa-trash" style="cursor: pointer"></i></button>
                            </div>
                            @endif
                            <div class="card card-forum" id="{{ $dt->id }}">
                                <div class="card-body">
                                    {{-- <div class="forum-action">
                                        <i class="fa fa-pencil" style="cursor: pointer"></i>&nbsp;
                                        <i class="fa fa-eye-slash" style="cursor: pointer"></i>&nbsp;
                                        <i class="fa fa-trash" style="cursor: pointer"></i>
                                    </div>
                                    <br> --}}
                                    <div class="d-flex justify-content-between">
                                        <p class="subject">{{ $dt->subject }}</p>
                                    </div>
                                    <p class="body-forum">
                                        {{ $dt->body }}
                                    </p>
                                    <div>
                                        <small>by {{ $dt->username }} {{ date('d/m/Y H:i:s', strtotime($dt->updated_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $data->onEachSide(5)->links() }}
            </div>
            <div class="col-md-4 form-forum">
                <div class="card">
                    <div class="card-body">
                        <h4>Post Forum</h4>
                        <form method="POST" action="{{ url('forum/store') }}" id="formUser">
                            @csrf
                            <div class="row mb-3">
                                <label for="noarsip">Judul/Subject <span class="required"></span></label>
                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                    <input type="text" name="subject" required="required" class="form-control" id="formSubject">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="noarsip">Isi <span class="required"></span></label>
                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                    <textarea name="body" id="formBody" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label for="noarsip"></label>
                                <div class='col-md-9 col-sm-9 col-xs-12'>
                                    <input type="radio" name="display" value="0" checked>
                                    <label for="">Private</label>
                                    &nbsp;
                                    <input type="radio" name="display" value="1">
                                    <label for="">Public</label>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>&nbsp;
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Edit</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="form-edit">
                <div class="modal-body">
                    @csrf
                    <div class="row mb-3">
                        <label for="noarsip">Judul/Subject <span class="required"></span></label>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <input type="text" name="subject" required="required" class="form-control" id="formEditSubject">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noarsip">Isi <span class="required"></span></label>
                        <div class='col-md-12 col-sm-12 col-xs-12'>
                            <textarea name="body" id="formEditBody" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <label for="noarsip"></label>
                        <div class='col-md-9 col-sm-9 col-xs-12'>
                            <input type="radio" name="display" value="0" id="private">
                            <label for="">Private</label>
                            &nbsp;
                            <input type="radio" name="display" value="1" id="public">
                            <label for="">Public</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Delete</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="form-delete">
                @csrf
                <div class="modal-body">
                    <p id="pesan-hapus"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
    <script>
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.card-forum').on('click', function(){
                let id = $(this).attr('id')
                location.href = APP_URL+"/forum/"+id
            })

            $('.edit-forum').on('click', function(){
                let id = $(this).attr('id').slice(5)

                $.ajax({
                    type: 'GET',
                    url: APP_URL+'/get-forum/'+id,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $('#formEditSubject').val(data.data.subject)
                        $('#formEditBody').val(data.data.body)
                        if(data.data.display == 1){
                            $('#public').attr('checked','checked')
                        }
                        else{
                            $('#private').attr('checked','checked')
                        }
                        $('#form-edit').attr('action', APP_URL+'/forum/store/'+id)

                        $('#modal-edit').modal('show')
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            })

            $('.delete-forum').on('click', function(){
                let id = $(this).attr('id').slice(7)

                $.ajax({
                    type: 'GET',
                    url: APP_URL+'/get-forum/'+id,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $('#pesan-hapus').html('Yakin ingin menghapus forum '+data.data.subject+' ?')
                        $('#form-delete').attr('action', APP_URL+'/forum/delete/'+id)
                        $('#modal-delete').modal('show')
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
            })
        })
    </script>
@endsection
