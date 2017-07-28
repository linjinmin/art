@extends('layout.admin')




@section('body')

    @include('layout.admin-nav')


    @include('admin.table-box')

    <div id="content" style="margin-top: 20px;">
        <!-- Start .content-wrapper -->
        <div class="content-wrapper">
            <a class='btn btn-purple' href='/admin/painting/type/add'>添加类型</a>
        </div>
    </div>

@endsection

