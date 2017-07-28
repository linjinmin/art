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
});
</script>


<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon-reset"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" method="post" id="login-form">

	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>园丁鸟</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>登录</span> <!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
        <div class="each-div">
            <!--USERNAME--><input name="email" type="text" class="input username" placeholder="请输入邮箱"  id="email" /><!--END USERNAME-->
            <span class="info" id="email-warn"></span>
        </div>

        <div class="each-div">
            <!--PASSWORD--><input name="password" type="password" class="input password" placeholder="请输入密码" id="password" /><!--END PASSWORD-->
            <span class="info" id="password-warn"></span>
        </div>
        <div style="margin-top: 15px;">
            <input type="checkbox" id="remember_token" name="remember_token"  value="1" style="-webkit-appearance:checkbox !important;">&nbsp;&nbsp;记住我
        </div>
    </div>
    <!--END CONTENT-->

    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><input type="button" name="submit" value="登录" class="button" onclick="login()" /><!--END LOGIN BUTTON-->
    <!--REGISTER BUTTON--><input type="button" name="submit" value="注册" class="register" onclick="window.location.href='/auth/register'" /><!--END REGISTER BUTTON-->
        <a href="/auth/reset" class="forget"> forget?</a>
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
        if (!emailCheck(this.value)){
            document.getElementById("email-warn").innerHTML = "请输入合法邮箱"
            emailFlag = 0
            return
        }

        document.getElementById("email-warn").innerHTML = ""
        emailFlag = 1

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
        passwordFlag = 1
        document.getElementById("password-warn").innerHTML = ""
    }

    //登录
    function login() {

        if (emailFlag == 0) {
            document.getElementById("email").focus()
            document.getElementById("email-warn").innerHTML = "请输入合法邮箱"
            return
        }

        if (passwordFlag == 0) {
            document.getElementById("password").focus()
            document.getElementById("password-warn").innerHTML = "密码长度应为6-16位"
            return
        }

        $.ajax({
            type: "POST",
            url: "/auth/login",
            data: {email:$("#email").val(), password:$("#password").val(), remember_token:$("#remember_token").is(':checked')},
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                if (data.status == 1) {
                    // 跳转界面
                    window.location.href = '/home/index'
                    toastr.success(data.info)
                } else {
                    toastr.error(data.info)
                }

            },

            error: function (data) {
                var errors = data.responseJSON
                for (var i in errors) {
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

    .forget{
        text-decoration: none;
        margin-top: 2px;
        position: absolute;
        padding:10px;
        color: #414848;
    }
</style>
@endsection