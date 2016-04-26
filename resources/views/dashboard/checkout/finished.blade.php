@extends('dashboard.layout')

@section('content')

    <div id="main-wrapper" class="container">
        <div class="panel panel-white">
            <div class="panel-body">
                <h1>@lang('checkout.completed')</h1>

                <div class="alert alert-success">
                    <b>@lang("invoice.new")</b> <br>@lang("invoice.please-pay")
                </div>
            </div>
        </div>
    </div>
@stop
