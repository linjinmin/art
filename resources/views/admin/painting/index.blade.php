@extends('layout.admin')




@section('body')

    @include('layout.admin-nav')

    @include('admin.table-box')

@endsection


@section('footer')

    <script>

        function paintingDelete(painting_id)
        {
            if (confirm('确认删除?')){
                $.ajax({
                    type: 'get',
                    url: '/admin/painting/delete/' + painting_id,
                    success: function(data) {
                        toastr.success('删除成功')
                        window.location.reload()
                    }
                })

            }
        }


    </script>


@endsection

