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

    <div class="message-bg">
        <div class="message-container fadein-up">
            <div class="bulletin-title" style="display: flex; justify-content: center;">
                <h1>消息</h1>
            </div>

            <div class="bulletin-content">
                <ul class="message-ul">
                    @foreach($personMessages as $message)
                        <li>
                            <p>{{$message->created_at->format('Y-m-d')}}</p>
                            {{ $message->content }}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>


@endsection