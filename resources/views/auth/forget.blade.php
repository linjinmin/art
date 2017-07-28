@extends('layout.auth')

@section('body')

    <!--Slider-in icons-->
    <script type="text/javascript">
        $(document).ready(function() {
            $(".username").focus(function() {
                $(".user-icon").css("left","-48px");
            });
            $(".username").blur(function() {
                $(".user-icon").css("left","0px");
            });

            $(".password").focus(function() {
                $(".pass-icon-reset").css("left","-48px");
            });
            $(".password").blur(function() {
                $(".pass-icon-reset").css("left","0px");
            });

            $(".repassword").focus(function() {
                $(".re-pass-icon-reset").css("left","-48px");
            });
            $(".repassword").blur(function() {
                $(".re-pass-icon-reset").css("left","0px");
            });


        });
    </script>

    <!--WRAPPER-->
    <div id="wrapper-register">

        <!--SLIDE-IN ICONS-->
        <div class="user-icon"></div>
        <div class="pass-icon-reset"></div>
        <div class="re-pass-icon-reset"></div>
        <!--END SLIDE-IN ICONS-->

        <!--LOGIN FORM-->
        <form name="login-form" class="login-form" method="post" id="register-form">

            <!--HEADER-->
            <div class="header">
                <!--TITLE--><h1>园丁鸟</h1><!--END TITLE-->
                <!--DESCRIPTION--><span>重置密码</span><!--END DESCRIPTION-->
            </div>
            <!--END HEADER-->

            <!--CONTENT-->
            <div class="content">
                <div class="each-div">
                    <!--USERNAME--><input name="email" type="text" class="input username" placeholder="请输入邮箱"  id="email" /><!--END USERNAME-->
                    <span class="info" id="email-warn"></span>
                </div>

                <div class="each-div">
                    <!--USERNAME--><input name="password" type="password" class="input password" placeholder="请输入密码"  id="password" /><!--END USERNAME-->
                </div>

                <div class="each-div">
                    <!--PASSWORD--><input name="password_confirmation" type="password" class="input repassword" placeholder="确认密码"  id="repassword" /><!--END PASSWORD-->
                    <span class="info" id="password-warn"></span>
                </div>
                    <!--PASSWORD--><input name="code" type="password" class="input code" placeholder="验证码"  id="code_val" /><!--END PASSWORD-->
                    <input type="button" class="code-btn" value="获取验证码" name="submit" id="code" onclick="getCode()">

            </div>
            <!--END CONTENT-->

            <!--FOOTER-->
            <div class="footer">
                <!--LOGIN BUTTON--><input type="button" name="submit" value="重置" class="button" onclick="resetPassword()" /><!--END LOGIN BUTTON-->
                <!--REGISTER BUTTON--><input type="button" name="submit" value="前往登录" class="register" onclick="window.location.href='/auth/login'" /><!--END REGISTER BUTTON-->
            </div>
            <!--END FOOTER-->

        </form>
        <!--END LOGIN FORM-->

    </div>
    <!--END WRAPPER-->

    <!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

    <script>

        var passwordFlag = 0
        var emailFlag = 0

        // 判断邮箱是否合法
        document.getElementById("email").onblur = function() {
            document.getElementById("email-warn").style.color = "red"
            if (!emailCheck(this.value)){
                document.getElementById("email-warn").innerHTML = "请输入合法邮箱"
                emailFlag = 0
                return
            }

            document.getElementById("email-warn").innerHTML = ""

            // 判断当前邮箱是否已被注册
            $.ajax({
                type: "GET",
                url : "/auth/email/check/" + this.value,
                dataType: "JSON",
                success: function(data) {
                    if (data.check == 1){
                        document.getElementById("email-warn").innerHTML = "邮箱不存在"
                        document.getElementById("email-warn").style.color = "red"
                    } else {
                        emailFlag = 1
                        document.getElementById("email-warn").innerHTML = "邮箱合法"
                        document.getElementById("email-warn").style.color = "green"
                    }
                },

                error:function (data) {
                    var errors = data.responseJSON
                    for (var i in errors){
                        toastr.error(errors[i][0])
                    }
                }

            })


        }


        // 邮箱验证
        function emailCheck(email)
        {
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/
            return reg.test(email)
        }


        // 密码验证
        document.getElementById("password").onblur = function() {
            if (this.value.length<6 || this.value.length>16){
                document.getElementById("password-warn").innerHTML = "密码长度应为6-16位"
                passwordFlag = 0
                return
            }

            document.getElementById("password-warn").innerHTML = ""
        }


        // 确认密码验证
        document.getElementById('repassword').onblur = function() {
            var password = document.getElementById('password').value
            if (password != this.value){
                document.getElementById("password-warn").innerHTML = "确认密码错误"
                passwordFlag = 0
                return
            }

            passwordFlag = 1

            document.getElementById("password-warn").innerHTML = ""

        }

        // 获取验证码
        function getCode()
        {

            if (emailCheck(document.getElementById("email").value)){
                emailFlag = 1
                document.getElementById("email-warn").innerHTML = "邮箱合法"
                document.getElementById("email-warn").style.color = "green"
            } else {
                document.getElementById("email").focus()
                document.getElementById("email-warn").innerHTML = "请输入合法邮箱"
                return
            }


            refreshmsg('code', 60)

            $.ajax({
                type: "POST",
                url : '/send/email',
                data: {email:document.getElementById('email').value},
                dataTyle: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },

                success: function(data) {
                    if (data.status == 1){
                        toastr.success(data.info)
                    } else {
                        toastr.error(data.info)
                    }
                },

                error: function(data){
                    var errors = data.responseJSON
                    for (var i in errors){
                        toastr.error(errors[i][0])
                    }
                }
            })
        }



        //刷新 消息
        function refreshmsg(id, t) {
            if (t > 0)
            {
                t--;
                setTimeout("refreshmsg('" + id + "'," + t +");", 1000);
                $("#" + id).val("过" + t + "后可发送");
                $("#" + id).attr("disabled", true)
            } else {
                $("#" + id).val("获取验证码");
                $("#" + id).attr("disabled", false)
            }
        }


        // 重置密码
        function resetPassword()
        {

            if (emailFlag == 0){
                document.getElementById("email").focus()
                document.getElementById("email-warn").innerHTML = "请输入合法邮箱"
                document.getElementById("email-warn").style.color = "red"
                return
            }

            if (passwordFlag == 0){
                document.getElementById("password").focus()
                document.getElementById("email-warn").innerHTML = "请输入密码"
                document.getElementById("password-warn").style.color = "red"
                return
            }


            $.ajax({
                type: "POST",
                dataType: "JSON",
                url : "/auth/reset",
                data: {
                    email:$("#email").val(),
                    password:$("#password").val(),
                    password_confirmation:$("#repassword").val(),
                    code: $("#code_val").val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(data) {
                    if (data.status == 1){
                        window.location.href = "/auth/login"
                        toastr.success(data.info)
                    } else {
                        toastr.error(data.info)
                    }
                },

                error: function(data) {
                    var errors = data.responseJSON
                    for (var i in errors){
                        toastr.error(errors[i][0])
                    }
                }
            })
        }




    </script>


    <style>
        .info{
            color:red;
            font-size: 12px;
            position: relative;
        }

        .each-div{
            display: flex;
            flex-direction: column;
            height: 67.4px;
        }


    </style>

@endsection