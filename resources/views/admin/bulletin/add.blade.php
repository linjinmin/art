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
                                    <h3 class="panel-title">Bulletin Form</h3>
                                </div>
                            </div>

                            <div class="panel-body">


                                <form class="form-horizontal group-border hover-stripped" role="form" method="POST" action="store">
                                    {!! csrf_field() !!}
                                    <div class="form-group">w
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">标题:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label">内容:</label>
                                        <div class="col-lg-10 col-md-10">
                                            <textarea name="content"  class="form-control elastic" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group" style="text-align: center">
                                        <button class='btn btn-purple'>发表</button>
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