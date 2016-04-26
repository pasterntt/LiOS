@extends('documents.blanko', ['creation'=>date("d.m.Y", $created), "copy"=>$copy])

@section('content')

    <h1>@lang('documents.about') @lang('documents.types.invoice')</h1>

@stop