@extends('layout.admin')




@section('body')

    @include('layout.admin-nav')

    @include('admin.table-box')

    <div id="content" style="margin-top: 20px;">
        <!-- Start .content-wrapper -->
        <div class="content-wrapper">
            <a class='btn btn-purple' href='/admin/bulletin/add'>发表公告</a>
        </div>
    </div>


@endsection

