@extends('layout.admin-auth')



@section('css')
    <style>
        body{
            background: #75b9e6;
        }

        .login-page #login {
            margin: 10% auto 0 auto;
            position: relative;
            width: 420px;
        }

        .login-page #login .login-wrapper{
            width: 100%;
            height: auto;
            background-color: #ffffff;
            border-radius: 4px;
            display: inline-block;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
        }

    </style>

@endsection

@section('body')

<div class="login-page">
    <div id="login" class="animated bounceIn">
        <!-- Start .login-wrapper -->
        <div class="login-wrapper">
            <div id="myTabContent" class="tab-content bn">
                <div class="tab-pane fade active in" id="log-in">
                    <form class="form-horizontal mt10" method="POST" id="login-form" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="text" name="email" id="email" class="form-control left-icon" placeholder="Your email ...">
                                <i class="ec-user s16 left-input-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="password" name="password" id="password" class="form-control left-icon" placeholder="Your password">
                                <i class="ec-locked s16 left-input-icon"></i>

                            </div>
                        </div>
                        <div class="form-group">

                            <!-- col-lg-12 end here -->
                                <!-- col-lg-12 start here -->
                            <button class="btn btn-success pull-right"  type="submit">Login</button>
                            <!-- col-lg-12 end here -->
                        </div>
                    </form>
                </div>
        </div>
        <!-- End #.login-wrapper -->
    </div>
</div>



@endsection