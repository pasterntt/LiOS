@extends('dashboard.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6">

        </div>
        <div class="col-lg-6">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h2>@lang('service.overview')</h2>
                    <hr>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>
                                @lang('service.service_name')
                            </th>
                            <th>
                                @lang('service.service_status')
                            </th>
                            <th>
                                @lang('service.actions')
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Http\Controllers\Helpers\ServiceHelper::getServicesByUser(Auth::user()->id) as $service)

                            <tr>
                                <td>
                                    {{$service->name}}
                                </td>
                                <td>
                                    <span class="label label-{{\App\Http\Controllers\Helpers\StatusHelper::returnStatus($service->status)['class']}}">{{trans(\App\Http\Controllers\Helpers\StatusHelper::returnStatus($service->status)['human_string'])}}</span>
                                </td>
                                <td>
                                    <!-- Split button -->
                                    <div class="btn-group">
                                        <a type="button" href="{{URL::to('services/manage/'.$service->id)}}"
                                           class="btn btn-default btn-sm">@lang('service.manage')</a>
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop