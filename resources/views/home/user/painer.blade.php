@extends('layout.home')

@section('header')
    <link rel="stylesheet" href="/css/webuploader.css">
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
    <script src="/js/webuploader.js"></script>

    <script>

        var number = 0
        var url = ""

        var uploader = WebUploader.create({
            // 文件接收服务端。
            server: '/image/apply',
            pick: '#picker',

            auto:true,

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/jpg,image/jpeg,image/png'
            }
        });


        // 判断是否已申请
        @if (isset($painer))
                var url = "{!! $painer->image->url !!}"
                @else
                    var url = ""
        @endif


        if (url){
            var $li = $(
                '<div id="' + '" style="padding: 5px;"">' +
                '<img>' +
                '</div>'
            )

            $list = $('#thelist')
            $list.append($li)
            $img = $list.find('img')
            $img.attr('src', url)
            $img.attr('height', 120)
            $img.attr('width', 260)
            $('#picker').hide()
            $('#apply').hide()
        }

        uploader.on( 'fileQueued', function( file ) {
            number = number + 1
            var $li = $(
                    '<div id="' + file.id + '" style="padding: 5px;"">' +
                    '<img>' +
                    '</div>'
                )


            $list = $('#thelist')

            // $list为容器jQuery实例
            if (url == ""){
                $list.append( $li );
                $img = $li.find('img');
            } else {
                $img = $list.find('img');
            }

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, 260, 120 );

        });

//        // 文件上传过程中创建进度条实时显示。
//        uploader.on( 'uploadProgress', function( file, percentage ) {
//            var $li = $( '#'+file.id ),
//                $percent = $li.find('.progress span');
//
//            // 避免重复创建
//            if ( !$percent.length ) {
//                $percent = $('<p class="progress"><span></span></p>')
//                    .appendTo( $li )
//                    .find('span');
//            }
//            $percent.css( 'width', percentage * 100 + '%' );
//        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file , data) {


            if (data.status == 1){
                url = data.url
                $("#url").val(url)
                toastr.success('上传文件成功')
            } else {
                toastr.error(data.info)
                $list = $("#thelist");
                $img  = $list.find('img')
                $img.attr( 'src', "" );
            }
        });


        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file, response ) {
            $list = $("#thelist");
            $img  = $list.find('img')
            $img.attr( 'src', "" );
            toastr.error("图片上传失败")
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {

        });


        function postApply()
        {
            if (url == ""){
                toastr.error('请选择图片')
                return
            }

            if ($('#describe').val() == ""){
                toastr.error('请介绍一下自己')
                return
            }

            $('#apply_form').submit()
        }


    </script>


@endsection


@section('body')


    <div class="info-bg ">
        <div class="painer-form fadein-up">
            <div style="text-align: center">
                <h2 class="painer-h">Application Form</h2>
            </div>

                <div class="painer-form-main">
                    <h3 class="painer-h3">Show Us Your Work:<span style="font-size: 13px">(One Photo Less Than 3M)</span></h3>

                    <div id="uploader" class="wu-example">
                        <!--用来存放文件信息-->
                        <div id="thelist" class="uploader-list" style="width: 100%;display: flex; justify-content: space-around;"></div>
                        <div class="painer-upload-btn btns">
                            <div id="picker">选择图片</div>
                        </div>
                    </div>

                    <form action="apply" method="POST" id="apply_form">
                        {!! csrf_field() !!}
                        <input type="hidden" name="url" id="url">

                        <h3 class="painer-h3">Introduce Yourself:</h3>
                        @if (isset($painer))
                            <div class="info-button" style="margin-top:10px;"><textarea name="describe" id="describe" class="painer-textarea" placeholder="please introduce yourself, no more than 255 words"  disabled >{{ $painer->describe }}</textarea></div>
                        @else
                            <div class="info-button" style="margin-top:10px;"><textarea name="describe" id="describe" class="painer-textarea" placeholder="please introduce yourself, no more than 255 words"></textarea></div>
                        @endif


                        <div class="info-button" >
                            <button class="button button-primary button-rounded button-middle" onclick="postApply()" type="button" id="apply">提交申请</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>


@endsection


