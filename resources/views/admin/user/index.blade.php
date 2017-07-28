@extends('layout.admin')




@section('body')

    @include('layout.admin-nav')


    @include('admin.table-box')



@endsection


@section('footer')


    <script>
        function setStatus(user_id, status)
        {
            if (confirm('确认禁用操作')){
                $.ajax({
                    type : 'get',
                    url: '/admin/user/status/' + user_id + '/' + status,
                    success:function(result){
                        if (result.status == 1){
                            toastr.success(result.info)
                            window.location.reload()
                        } else {
                            toastr.error(result.info)
                        }
                    }

                })
            }
        }


        function deprivation(user_id)
        {
            if (confirm('确认剥夺权利')){
                $.ajax({
                    type: 'get',
                    url: '/admin/user/deprivation/' + user_id,
                    success:function(result){
                        if (result.status == 1){
                            toastr.success(result.info)
                            window.location.reload()
                        } else {
                            toastr.error(result.info)
                        }
                    }

                })

            }
        }



    </script>


@endsection