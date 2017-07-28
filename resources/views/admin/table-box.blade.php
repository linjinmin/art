<div id="content" style="margin-top: 20px;">
    <!-- Start .content-wrapper -->
    <div class="content-wrapper">
        <div class="outlet">
            <!-- Start .outlet -->
            <!-- Page start here ( usual with .row ) -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- col-lg-12 start here -->
                    <div class="panel panel-default plain">

                        <div class="panel-body">
                            <div class="row">
                                @if (isset($filters))
                                    <form method="get" class="form-inline">
                                        <div class="form-group">
                                            @foreach($filters as $filter_name => $filter)
                                                @if (isset($filter['type']) && $filter['type'] == 'select')
                                                    <label for="{{ $filter_name }}">{{ $filter['label'] }}</label>
                                                    <select name="{{ $filter_name }}" id="{{ $filter_name }}" class="form-control" >
                                                        @foreach($filter['options'] as $option_label => $option_value)
                                                            <option value="{{ $option_value }}" {{ request()->input($filter_name)==$option_value?"selected='selected'":"" }}>{{ $option_label }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <label for="{{ $filter_name }}">{{ $filter['label'] }}</label>
                                                    <input class="form-control" type="{{ $filter['type'] }}" id="{{ $filter_name }}"
                                                           name="{{ $filter_name }}" placeholder="{{ $filter['label'] }}"
                                                           value="{{ request()->input($filter_name) }}">

                                                @endif
                                            @endforeach
                                            <button type="submit" class="btn btn-primary pull-right">查询</button>
                                        </div>
                                    </form>
                                @endif
                                <div class="col-lg-6 col-md-6 col-sm-12 text-center">

                                </div>
                            </div>
                            <table class="table display" id="datatable">
                                <thead>
                                <tr>
                                    @foreach(array_keys($trs) as $th)
                                        <th>{{ $th }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($objects as $object)
                                    <tr>
                                        @foreach($trs as $td)
                                            <td>{!! $td($object) !!}</td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="{{ count($trs) }}">
                                            <h3 class="text-center text-muted">
                                                没有记录
                                            </h3>
                                        </th>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $objects->render() }}
                    </div>
                    <!-- End .panel -->
                </div>
                <!-- col-lg-12 end here -->
            </div>
        </div>
        <!-- End .outlet -->
    </div>
    <!-- End .content-wrapper -->
    <div class="clearfix"></div>
</div>