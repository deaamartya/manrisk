@extends('layouts.user.table')
@section('title', 'Forum')
@section('style')
    <style>
        .subject {
            font-weight: bold;
            font-size: 120%;
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
                <div class="row">
                    <div class="card" id="card_1">
                        <div class="card-body">
                            <div class="forum-action">
                                <i class="fa fa-pencil" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-eye-slash" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-trash" style="cursor: pointer"></i>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between">
                                <p class="subject">Subject Subject Subject Subject Subject Subject </p>
                            </div>
                            <p class="body-forum">content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                            </p>
                            <div>
                                <small>by Admin 15/05/2022 23:48:10</small>&nbsp;<i class="fa fa-comments text-comment" id="comment_1" style="cursor: pointer"> comment</i>&nbsp;<span class="badge rounded-pill badge-info">4</span>
                            </div>
                            <div class="body-comment" id="body_comment_1">
                                <hr>
                                <textarea name="comment" id="formComment" class="form-control" placeholder="Komentar" rows="2"></textarea>
                                <br>
                                <button type="button" class="btn btn-sm btn-secondary">Kirim</button>
                                <hr>
                                <p>comment comment comment comment comment comment comment comment comment comment comment.</p>
                                <small>by Admin 15/05/2022 23:48:10 | <span class="hapus-comment">Hapus</span></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="forum-action">
                                <i class="fa fa-pencil" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-eye-slash" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-trash" style="cursor: pointer"></i>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between">
                                <p class="subject">Subject Subject Subject Subject Subject Subject </p>
                            </div>
                            <p class="body-forum">content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                            </p>
                            <div>
                                <small>by Admin 15/05/2022 23:48:10</small>&nbsp;<i class="fa fa-comments text-comment" style="cursor: pointer"> comment</i>&nbsp;<span class="badge rounded-pill badge-info">4</span>
                            </div>
                            <div class="body-comment">
                                <hr>
                                <textarea name="comment" id="formComment" class="form-control" placeholder="Komentar" rows="2"></textarea>
                                <br>
                                <button type="button" class="btn btn-sm btn-secondary">Kirim</button>
                                <hr>
                                <p>comment comment comment comment comment comment comment comment comment comment comment.</p>
                                <small>by Admin 15/05/2022 23:48:10 | <span class="hapus-comment">Hapus</span></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="forum-action">
                                <i class="fa fa-pencil" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-eye-slash" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-trash" style="cursor: pointer"></i>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between">
                                <p class="subject">Subject Subject Subject Subject Subject Subject </p>
                            </div>
                            <p class="body-forum">content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                            </p>
                            <div>
                                <small>by Admin 15/05/2022 23:48:10</small>&nbsp;<i class="fa fa-comments text-comment" style="cursor: pointer"> comment</i>&nbsp;<span class="badge rounded-pill badge-info">4</span>
                            </div>
                            <div class="body-comment">
                                <hr>
                                <textarea name="comment" id="formComment" class="form-control" placeholder="Komentar" rows="2"></textarea>
                                <br>
                                <button type="button" class="btn btn-sm btn-secondary">Kirim</button>
                                <hr>
                                <p>comment comment comment comment comment comment comment comment comment comment comment.</p>
                                <small>by Admin 15/05/2022 23:48:10 | <span class="hapus-comment">Hapus</span></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="forum-action">
                                <i class="fa fa-pencil" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-eye-slash" style="cursor: pointer"></i>&nbsp;
                                <i class="fa fa-trash" style="cursor: pointer"></i>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between">
                                <p class="subject">Subject Subject Subject Subject Subject Subject </p>
                            </div>
                            <p class="body-forum">content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                                content content content content content content content content content content content
                            </p>
                            <div>
                                <small>by Admin 15/05/2022 23:48:10</small>&nbsp;<i class="fa fa-comments text-comment" style="cursor: pointer"> comment</i>&nbsp;<span class="badge rounded-pill badge-info">4</span>
                            </div>
                            <div class="body-comment">
                                <hr>
                                <textarea name="comment" id="formComment" class="form-control" placeholder="Komentar" rows="2"></textarea>
                                <br>
                                <button type="button" class="btn btn-sm btn-secondary">Kirim</button>
                                <hr>
                                <p>comment comment comment comment comment comment comment comment comment comment comment.</p>
                                <small>by Admin 15/05/2022 23:48:10 | <span class="hapus-comment">Hapus</span></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 form-forum">
                <div class="card">
                    <div class="card-body">
                        <h4>Post Forum</h4>
                        <form method="POST" action="" id="formUser">
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

{{-- <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Post</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="">
                @csrf

            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="submit">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection

@section('custom-script')
    <script>
        const APP_URL = {!! json_encode(url('/')) !!}
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.card .text-comment').on('click', function(){
                let id = $(this).attr('id').slice(8)
                let x = document.getElementById('body_comment_'+id)
                if (getComputedStyle(x, "").display === "none") {
                    x.style.display = "block"
                }
                else{
                    x.style.display = "none"
                }
            })
        })
    </script>
@endsection
