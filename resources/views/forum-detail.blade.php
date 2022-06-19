@extends('layouts.user.table')
@section('title', 'Forum')
@section('style')
    <style>
        .subject {
            font-weight: bold;
            font-size: 120%;
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
            <div class="col-md-8">
                <div class="col call-chat-body">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row chat-box">
                            <!-- Chat right side start-->
                                <div class="col pe-0 chat-right-aside">
                                    <!-- chat start-->
                                    <div class="chat">
                                        <div class="chat-header clearfix">
                                            @if(count($forum_detail) < 1)
                                                <h6>Belum ada tanggapan</h6>
                                            @else
                                                <h6>Tanggapan</h6>
                                            @endif
                                        </div>
                                        <div class="chat-history chat-msg-box custom-scrollbar">
                                            <ul>
                                                @foreach ($forum_detail as $fd)
                                                    @if($fd->id_user != auth()->user()->id_user)
                                                        <li>
                                                            <div class="message my-message" style="background-color: #abf08e; color: #201b1b">{{ $fd->username }}
                                                                <div class="text-end"><span>{{ date('d/m/Y H:i:s', strtotime($fd->created_at)) }}</span></div>
                                                                {{ $fd->body }}
                                                            </div>
                                                        </li>
                                                    @else
                                                        <li class="clearfix">
                                                            <div class="message other-message pull-right" style="background-color: rgb(126 207 248); color: #201b1b">
                                                                <div><span>{{ date('d/m/Y H:i:s', strtotime($fd->created_at)) }}</span></div>
                                                                {{ $fd->body }}
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- end chat-history-->
                                        <form action="{{ url('forum-detail/store/'.$forum->id) }}" method="post">
                                            @csrf
                                            <div class="chat-message clearfix">
                                                <div class="row">
                                                    <div class="col-sm-12 d-flex">
                                                        <div class="input-group text-box">
                                                            <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message" placeholder="Type a message......" data-bs-original-title="" title="" required>
                                                            <button class="input-group-text btn btn-danger" type="submit" data-bs-original-title="" title="">SEND</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <!-- end chat-message-->
                                    <!-- chat end-->
                                    <!-- Chat right side ends-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="subject">{{ $forum->subject }}</p>
                            </div>
                            <p class="body-forum">
                                {{ $forum->body }}
                            </p>
                            <div>
                                <small>by {{ $forum->username }} {{ date('d/m/Y H:i:s', strtotime($forum->updated_at)) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('forum') }}"><button type="button" class="btn btn-warning" style="margin-bottom: 10px; color: black">Kembali</button></a>
    </div>
</div>

@endsection

@section('custom-script')
    <script>
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript">

    </script>
@endsection
