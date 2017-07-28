@extends('layout.admin')


@section('css')
    <style>
        #content{
            margin-top: 50px;
        }

        .form-horizontal .control-label, .form-horizontal .radio, .form-horizontal .checkbox, .form-horizontal .radio-inline, .form-horizontal .checkbox-inline {
            padding-top: 0px !important;
        }

        p{
            display: -webkit-box;
            overflow : hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

    </style>

@endsection

@section('body')

    @include('layout.admin-nav')

    <div id="content">
        <div class="content-wrapper">
            <div class="outlet">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default toggle" id="spr_0">
                            <div class="panel-heading">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Apply Form</h3>
                                </div>
                            </div>

                            <div class="panel-body">


                                <form class="form-horizontal group-border hover-stripped" role="form">
                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">用户名:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <span>{{ $apply->user->nickname }}</span>
                                            {{--<input type="email" class="form-control" placeholder="Type your email">--}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">邮箱:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <span>{{ $apply->user->email }}</span>
                                            {{--<input type="email" class="form-control" placeholder="Type your email">--}}
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">自我介绍:</label>
                                        <div class="col-lg-10 col-md-10" style="word-wrap: break-word">
                                            {{ $apply->describe }}
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">状态:</label>
                                        <div class="col-lg-10 col-md-10" style="word-wrap: break-word">
                                            {{ $apply->status }}
                                        </div>
                                    </div>


                                    <div class="form-group" style="text-align: center">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">图片:</label>
                                        <img src="{{ $apply->image->url }}" alt="" style="max-width: 760px;">
                                    </div>


                                    @if ($apply->status == \DDL\Models\PainerApply::STATUS_WAIT)
                                        <div class="form-group" style="text-align: center">
                                            <a href="/admin/apply/review/{{$apply->id}}/-1" class="btn btn-danger">拒绝</a>
                                            <a href="/admin/apply/review/{{$apply->id}}/1" class="btn btn-success">通过</a>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection


@section('footer')



@endsection