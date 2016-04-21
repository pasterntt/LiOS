@extends('auth.layout')

@section('form')
    <form class="m-t-md" action="{{URL::to('/')}}/auth/register" method="post">
        <div class="form-group">
            <input type="text" id="name" name="name" class="form-control" placeholder="@lang('forms.name')" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <input type="email" id="email" name="email" class="form-control" placeholder="@lang('forms.email')" autocapitalize="off" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="@lang('forms.password')">
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('forms.confirm_password')">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-success btn-block m-t-xs">@lang('forms.submit')</button>
        <p class="text-center m-t-xs text-sm">@lang('auth.login.acc_yes')</p>
        <a href="{{URL::to('auth/login')}}" class="btn btn-default btn-block m-t-xs">@lang('auth.login.login')</a>
    </form>
@stop