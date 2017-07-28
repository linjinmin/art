@extends('layout.home')

@section('header')

    <link rel="stylesheet" href="/croppic/croppic.css"/>
    <link rel="stylesheet" href="/css/button.css">


    <style>
        .crop-contaniner{
            height: 250px;
            width: 350px;
            margin-top: 200px;
            position: absolute;
            left: 50%;
            z-index: 1000;
            margin-left: -175px;
            top: 30%;
            margin-top: -156px;
        }

        .cropControls{
            left: 11.1rem;
            top: 11.1rem;
            right: inherit;
        }


        .croppedImg{
            height: 100%;
            width: 100%;
            z-index: 500;
        }




         .common-footer{
             position: relative;
             background: #333;
         }



    </style>

@endsection

@section('footer')
    @include('layout.footer')

    <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="/croppic/croppic.js"></script>

    <script>
        var eyeCandy = $('#cropContainerEyecandy');
        var croppedOptions = {
            uploadUrl: '/image/avatar',
            cropUrl: '/image/crop/cover',
            onAfterImgCrop:		function(){
                var cropImg = document.getElementById('crop')
                document.getElementById('avatar').setAttribute('src', cropImg.src + "?t=" + Math.random())
            },
            cropData:{
                width : 256,
                height: 256
            }
        };
        var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
    </script>

@endsection



@section('body')


    <div class="info-bg">
        <div class="info-container">
            <div class="info-show">
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <div class="info-top-bg"></div>
                    <div class="info-image">
                        <div id="cropContainerEyecandy" class="crop-contaniner"></div>
                        <img src="{{$user->image->url}}" alt="" id="avatar">
                    </div>
                    {{--<div id="picker" style="position: absolute; left: 38%;top: 30%;">选择图片</div>--}}

                    <div class="info-nickname" style="top: 42%;"><p>{{$user->nickname}}</p></div>
                    <div class="info-signature"><textarea name="signature" id="" rows="3" style="padding: 5px;">{{$user->signature}}</textarea></div>

                    <div class="info-live">
                        <div class="info-live-show">
                            <p>邮箱：{{$user->email}}</p>
                        </div>

                        <div class="info-live-show">
                            <scan>性别：</scan>
                            <select name="sex" id="">
                                <option value="保密" {{$user->sex=="保密"?"select":""}}>保密</option>
                                <option value="男"   {{$user->sex=="男"?"select":""}}>男</option>
                                <option value="女"   {{$user->sex=="女"?"select":""}}>女</option>
                            </select>
                        </div>

                        <div class="info-live-show">
                            @if ($user->role == 'member')
                                <p>角色：会员</p>
                            @elseif ($user->role=='manager')
                                <p>角色：管理员</p>
                            @else
                                <p>角色：画家</p>
                            @endif
                        </div>

                        <div class="info-button">
                            <button class="button button-primary button-rounded button-middle">确认</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection

