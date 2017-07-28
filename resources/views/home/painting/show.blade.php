@extends('layout.home')


@section('header')

    <link rel="stylesheet" href="/css/button.css">
    <style>
        .common-footer{
            position: relative;
            background: #333;
        }

    </style>
@endsection


@section('footer')

    @include('layout.footer')

    <script>

        function reply(name)
        {
            document.getElementById('content').focus()
            document.getElementById('content').innerHTML = '@' + name + ' ';
        }


        {{--function postComment(painting_id)--}}
        {{--{--}}
            {{--var content = document.getElementById('content').value--}}
            {{--if (content == ""){--}}
                {{--toastr.error("内容不能为空")--}}
                {{--return--}}
            {{--}--}}

            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--dataType: "JSON",--}}
                {{--url: "/home/comment",--}}
                {{--data: {content:content, painting_id:painting_id, _token:"{{csrf_token()}}"},--}}
                {{--success:function(){--}}
                    {{--toastr.success('发表评论成功')--}}
                    {{--window.location.reload()--}}
                {{--}--}}
            {{--})--}}


        {{--}--}}


    </script>

@endsection


@section('body')


    <div class="painting-show-bg">

        <div style=" display: flex;justify-content: space-around;">
            <div class="painting-show-left">

                <div class="painting-show-work-img">
                    <img src="{{$painting->image->url}}" alt="">
                </div>
            </div>


            <div class="painting-show-right">
                <div class="painting-show-title-introduce">
                    <div class="painting-show-header">
                        <div class="painting-show-work-info">
                            <p style="font-size: 25px;font-weight: 500;line-height: 25px;">{{ $painting->title }}</p>
                            <p style="font-size: 15px;font-weight: 300; line-height: 22px;">{{ $painting->introduction }} </p>
                            <p style="font-size: 12px; line-height: 20px;"><a href="/home/user/info/{{ $painting->user->nickname }}" ><i class="icon-user"></i>&nbsp;{{ $painting->user->nickname }}</a>,&nbsp;&nbsp;&nbsp;<i class="icon-time"></i> &nbsp;{{$painting->created_at->format('Y-m-d:H:m:s')}}</p>
                        </div>
                    </div>
                </div>


                <div class="painting-show-user-works">
                    <div class="user-info">
                    <a href="/home/user/info/{{ $painting->user->nickname }}" ><img src="{{ $painting->user->image->url }}" alt="" height="50px" width="50px" style="border-radius: 25px; border: 1px solid rgb(132,155,221)"></a>
                        <div class="detail">
                            <p style="font-size: 18px; font-weight: 500;">{{$painting->user->nickname}}</p>
                            <p style="font-size:13px; font-weight: 400;">{{$painting->user->signature}}</p>
                        </div>
                    </div>

                    @if (count($works) > 0)
                        <div style="padding: 0px 0px 0px 20px;">
                            <p style="font-size: 20px;">同期作品:</p>
                        </div>

                        <div class="painting-show-user-works-container">
                            {{--<div class="am-container" id="am-container">--}}
                                @foreach($works as $work)
                                    <a href="/home/painting/show/{{$work->id}}" target="_blank"><img src="{{  $work->image->url }}" width="105px"></a>
                                @endforeach
                            {{--</div>--}}
                        </div>
                    @endif





                </div>

            </div>
        </div>


        <div class="painting-show-work-comment">

            @foreach($comments as $comment)
                <div class="comment-body">
                    <div class="heading">
                        <div style="display: inline-block; vertical-align: middle">
                            <img src="/images/default.jpeg" alt="" style="width: 20px;height: 20px;border-radius: 10px">
                        </div>
                        &nbsp;{{$comment->user->nickname}},&nbsp;&nbsp;<i class="icon-time"></i>&nbsp;{{$comment->created_at->format('Y-m-d:H:m:s')}}<span style="float:right;margin-top: 7px;" onclick="reply('{{$comment->user->nickname}}')"><i class=" icon-reply"></i></span>
                    </div>
                    <div class="body">
                        <p>{!! $comment->content !!}</p>
                    </div>
                </div>
            @endforeach

        </div>

        @if(isset($user))
            <form action="/home/comment" method="POST" style="width: 100%">
                <div class="painting-show-work-textarea editor">
                    {!! csrf_field() !!}
                    <input type="hidden" name="painting_id" value="{{$painting->id}}">
                    <textarea id="content" rows="6" name="content" placeholder="Markdown but no suppose upload file" class="form-control"></textarea>
                    <button type="submit" class="button button-primary button-rounded button-middle" style="float:right; margin-top:5px;">发表评论</button>
                </div>
            </form>
        @endif



    </div>



@endsection