@extends('layouts.user.table')
@section('title', 'Forum')
@section('style')
    <style>
        .subject {
            font-weight: bold;
            font-size: 120%;
        }
        .card {
            cursor: pointer;
        }
        .card:hover {
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
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="subject">Subject Subject Subject Subject Subject Subject </p>
                        </div>
                        <p class="body-forum">content content content content content content content content content content content
                            content content content content content content content content content content content
                            content content content content content content content content content content content
                            content content content content content content content content content content content
                        </p>
                        <div>
                            <small>by Admin 15/05/2022 23:48:10</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                        <!-- Chat right side start-->
                            <div class="col pe-0 chat-right-aside">
                                <!-- chat start-->
                                <div class="chat">
                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                        <ul>
                                        <li>
                                            <div class="message my-message">Name
                                            <div class="message-data text-end"><span class="message-data-time">10:12 am</span></div>                                                            Are we meeting today? Project has been already finished and I have results to show you.
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="message other-message pull-right">
                                            <div class="message-data"><span class="message-data-time">10:14 am</span></div>                                                            Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so?
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="message other-message pull-right">
                                            <div class="message-data"><span class="message-data-time">10:14 am</span></div>                                                            Well I am not sure. The rest of the team
                                            </div>
                                        </li>
                                        <li>
                                            <div class="message my-message">Name
                                            <div class="message-data text-end"><span class="message-data-time">10:20 am</span></div>                                                            Actually everything was fine. I'm very excited to show this to our team.
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                    <!-- end chat-history-->
                                    <div class="chat-message clearfix">
                                        <div class="row">
                                            <div class="col-xl-12 d-flex">
                                                <div class="input-group text-box">
                                                    <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message......" data-bs-original-title="" title="">
                                                    <button class="input-group-text btn btn-primary" type="button" data-bs-original-title="" title="">SEND</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    </div>
</div>

@endsection

@section('custom-script')
    <script>
        const APP_URL = {!! json_encode(url('/')) !!}
        const user = {!! auth()->user()->toJson() !!}
    </script>
    <script type="text/javascript">

    </script>
@endsection
