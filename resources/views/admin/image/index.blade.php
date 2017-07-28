@extends('layout.admin')




@section('body')

    @include('layout.admin-nav')


    @include('admin.table-box')



@endsection


@section('footer')
    <script>

        function imageReset(image_id)
        {
            if (confirm('是否确认重置图片,操作不可逆')){
                $.ajax({
                    type : 'get',
                    url: '/admin/image/reset/' + image_id,
                    success : function() {
                        toastr.success('操作成功')
                        window.location.reload()
                    }
                })
            }
        }

    </script>


@endsection