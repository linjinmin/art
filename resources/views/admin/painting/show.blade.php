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
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">昵称:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <span>{{ $painting->user->nickname }}</span>
                                            {{--<input type="email" class="form-control" placeholder="Type your email">--}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">邮箱:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <span>{{ $painting->user->email }}</span>
                                            {{--<input type="email" class="form-control" placeholder="Type your email">--}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">类型:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <span>{{ $painting->paintingType->name }}</span>
                                            {{--<input type="email" class="form-control" placeholder="Type your email">--}}
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">标题:</label>
                                        <div class="col-lg-10 col-md-10" style="word-wrap: break-word">
                                            {{ $painting->title }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">描述:</label>
                                        <div class="col-lg-10 col-md-10" style="word-wrap: break-word">
                                            {{ $painting->introduction }}
                                        </div>
                                    </div>

                                    <div class="form-group" style="text-align: center">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">图片:</label>
                                        <img src="{{ $painting->image->url }}" alt="" style="max-width: 760px;">
                                    </div>
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