@extends('layout.home')



@section('header')

    <link rel="stylesheet" type="text/css" href="/montage/css/style.css" />



    <style>
        .common-footer{
            position: relative;
            background: #333;
        }

        .work-bg{
            min-height: 920px;
        }
    </style>


@endsection


@section('footer')


    <script type="text/javascript" src="/montage/js/jquery1.6.2.min.js"></script>
    <script type="text/javascript" src="/montage/js/jquery.montage.min.js"></script>
    <script src="/js/headerwork.js"></script>
    <script type="text/javascript">
        var page = 2


            $(function() {
                /*
                 * just for this demo:
                 */
                $('#showcode').toggle(
                    function() {
                        $(this).addClass('up').removeClass('down').next().slideDown();
                    },
                    function() {
                        $(this).addClass('down').removeClass('up').next().slideUp();
                    }
                );
                $('#panel').toggle(
                    function() {
                        $(this).addClass('show').removeClass('hide');
                        $('#overlay').stop().animate( { left : - $('#overlay').width() + 20 + 'px' }, 300 );
                    },
                    function() {
                        $(this).addClass('hide').removeClass('show');
                        $('#overlay').stop().animate( { left : '0px' }, 300 );
                    }
                );

                var $container 	= $('#am-container'),
                    $imgs		= $container.find('img').hide(),
                    totalImgs	= $imgs.length,
                    cnt			= 0;


                $imgs.each(function(i) {
                    var $img	= $(this);
                    $('<img/>').load(function() {
                        ++cnt;
                        if( cnt === totalImgs ) {
                            $imgs.show();
                            $container.montage({
                                minw : 100,
                                alternateHeight : true,
                                alternateHeightRange : {
                                    min	: 50,
                                    max	: 350
                                },
                                margin : 8,
                                fillLastRow : true
                            });

                            /*
                             * just for this demo:
                             */
                            $('#overlay').fadeIn(500);
//                            var imgarr	= new Array();
//                            for( var i = 1; i <= 73; ++i ) {
//                                imgarr.push( i );
//                            }
                            $('#loadmore').show().bind('click', function() {

                                $.ajax({
                                    type: "GET",
                                    url: "/ajax/work/" + page,
                                    success: function(data){
                                        page += 1
                                        var paintings = data.paintings
                                        var newimgs = ""
                                        for(var i in paintings) {
//                                            var pos = Math.floor( Math.random() * len ),
//                                                src	= imgarr[pos];
                                            src = paintings[i].url
                                            var imageId = paintings[i].id;
                                            newimgs	+= '<a href="/home/painting/show/ '+ imageId + '"><img src="' + src+'"/></a>';
                                        }

                                        var $newimages = $( newimgs );
                                        $newimages.imagesLoaded( function(){
                                            $container.append( $newimages ).montage( 'add', $newimages );
                                        });

                                    },
                                    error: function(){
                                        toastr.error('服务器错误。')
                                    }

                                })

//                                var len = imgarr.length;
//                                for( var i = 0, newimgs = ''; i < 15; ++i ) {
//                                    var pos = Math.floor( Math.random() * len ),
//                                        src	= imgarr[pos];
//                                    newimgs	+= '<a href="#"><img src="images/' + src + '.jpg"/></a>';
//                                }
//
//                                var $newimages = $( newimgs );
//                                $newimages.imagesLoaded( function(){
//                                    $container.append( $newimages ).montage( 'add', $newimages );
//                                });
                            });
                        }
                    }).attr('src',$img.attr('src'));
                });

            });
    </script>



@endsection


@section('body')

    <div class="work-bg">
        <div class="am-container" id="am-container">
            @foreach($paintings as $painting)
                <a href="/home/painting/show/{{$painting->id}}" target="_blank"><img src="{{  $painting->url }}" style="max-width: 600px"></a>
            @endforeach
        </div>

    </div>
    @if (count($paintings) != 0)
        <div id="loadmore" class="work-loadmore" >加载更多</div>
        @else
        <div class="work-loadmore" style="background:rgba(132,155,221,.5)"></div>
    @endif





@endsection