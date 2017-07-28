@extends('layout.home')


@section('header')
    <style>
        .common-footer{
            position: relative;
            background: #333;
        }

    </style>
@endsection

@section('footer')
    @include('layout.footer')
@endsection

@section('body')

    @if (isset($userInfo))
        <div class="info-bg">
            <div class="info-container">
                <div class="info-show">
                    <div class="info-top-bg"></div>
                    <a href="/home/user/info/edit"><div class="info-edit"></div></a>
                    <div class="info-image">
                        <img src="{{$userInfo->image->url}}" alt="">
                    </div>
                    <div class="info-nickname"><p>{{$userInfo->nickname}}</p></div>
                    <div class="info-signature"><p>{{$userInfo->signature?:"空"}}</p></div>

                    <div class="info-live">
                        @if (isset($user))
                            <div class="info-live-show">
                                <p>邮箱：{{ ($userInfo->id==$user->id)?$userInfo->email:"************"}}</p>
                            </div>
                        @else
                            <div class="info-live-show">
                                <p>邮箱：************</p>
                            </div>
                        @endif

                        <div class="info-live-show">
                            <p>性别：{{$userInfo->sex}}</p>
                        </div>

                        <div class="info-live-show">
                            @if ($userInfo->role == 'member')
                                <p>角色：会员</p>
                            @elseif ($userInfo->role=='manager')
                                <p>角色：管理员</p>
                            @else
                                <p>角色：画家</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="info-work-container">
                @if (count($works) > 0)
                    <div class="painting-show-user-works-container">
                        {{--<div class="am-container" id="am-container">--}}
                        @foreach($works as $work)
                            <a href="/home/painting/show/{{$work->id}}" target="_blank"><img src="{{  $work->image->url }}" width="150px"></a>
                        @endforeach
                        {{--</div>--}}
                    </div>
                @else
                    <p style="font-size: 18px;">暂无作品</p>
                @endif
            </div>


        </div>
    @endif






@endsection

