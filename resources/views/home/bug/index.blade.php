@extends('layout.home')


@section('header')
    <link rel="stylesheet" href="/css/button.css">


@endsection


@section('footer')
    @include('layout.footer')

@endsection


@section('body')

    <div class="bug-bg">
        <div class="bug-form fadein-up">
            <div style="text-align: center">
                <h2 class="painer-h">Bug Form</h2>
            </div>

            <div class="painer-form-main">
                <form action="/home/bug" method="POST" id="apply_form">
                    {!! csrf_field() !!}
                    <input type="hidden" name="url" id="url">

                    <h3 class="painer-h3">Describe Bug:</h3>
                    <div class="info-button" style="margin-top:10px;"><textarea name="content" id="describe" class="painer-textarea" placeholder="Please describe the operation of the bug"></textarea></div>
                    <div class="info-button" >
                        <button class="button button-primary button-rounded button-middle" type="submit" id="apply">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection