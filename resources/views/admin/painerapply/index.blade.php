@extends('layout.admin')




@section('body')

    @include('layout.admin-nav')


    @include('admin.table-box')



@endsection


@section('footer')


    <script>
        function setStatus(user_id, status)
        {
            if (confirm('确认操作')){
                $.ajax({
                    type : 'get',
                    url: '/admin/user/status/' + user_id + '/' + status,
                    success: function() {
                        toastr.success('删除成功')
                        location.reload();
                    }
                })
            }
        }



    </script>


@endsection