@extends('dashboard.layout')
@section('content')
    @if(DB::table('vps')->where('owner', Auth::user()->id)->count() >0)

        <div class="row">
            @foreach($servers as $server)

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$server->hostname}}</h3>
                        </div>
                        <div class="panel-body">
                            <p>@lang('virtual.status'): <span class="label label-primary status" id="{{$server->id}}" data-virtualid="{{$server->id}}">Unknown</span> </p>
                            <a href="{{URL::to('virtual/manage/'.$server->hostname)}}" class="btn btn-default">@lang('virtual.manage')</a>
                        </div>
                    </div>

                </div>

                @endforeach
        </div>
    @else
        <div class="alert alert-info" role="alert">
            @lang('virtual.no_servers')
        </div>
    @endif
@stop