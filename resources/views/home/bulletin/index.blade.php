@extends('layout.home')


@section('header')

@endsection


@section('footer')
    @include('layout.footer')

@endsection



@section('body')

    <div class="bulletin-bg">
        <div class="bulletin-container fadein-up">
            <div class="bulletin-title" style="display: flex; justify-content: center;">
                <h1>{{ $bulletin->title }}</h1>
            </div>

            <div class="bulletin-content">
                <span> {{ $bulletin->content }} </span>
            </div>

        </div>
    </div>


@endsection