@extends('auth.layout', ['page'=>'auth.login'])

@section('form')
    <form action="{{URL::to('/')}}/auth/login" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="@lang('forms.email')" autocapitalize="off" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="@lang('forms.password')">
        </div>
        <button type="submit" class="btn btn-success btn-block">@lang('forms.submit')</button>
        <a href="forgot.html" class="display-block text-center m-t-md text-sm">@lang('auth.login.forgot')</a>
        <p class="text-center m-t-xs text-sm">@lang('auth.login.no_acc_q')</p>
        <a href="{{URL::to('auth/register')}}" class="btn btn-default btn-block m-t-md">@lang('auth.login.create_acc')</a>
    </form>
@stop