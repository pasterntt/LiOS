@extends('documents.blanko', ['creation'=>date("d.m.Y", $created), "copy"=>$copy, "contact"=>$client])

@section('content')

    <h1>@lang('documents.about') @lang('documents.types.invoice')</h1>
    @lang('invoice.created-date'): {{date("d.m.Y", $created)}}
    <table width="100%" border="1px">
        <thead>
        <tr>
            <th>
                @lang('shop.cart.product.name')
            </th>
            <th>
                @lang('shop.cart.product.datacenter')
            </th>
            <th>
                @lang('shop.cart.product.price')
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($items['items'] as $cart_item)
            <tr>
                <td>{{$cart_item['name']}}</td>
                <td>{{$cart_item['datacenter']->name}} ({{$cart_item['datacenter']->city}}
                    ,{{$cart_item['datacenter']->country}})
                </td>
                <td>{{$cart_item['price']}}&euro;</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">
                @lang("invoice.total")
            </td>
            <td>
                {{$items['total']}}&euro;
            </td>
        </tr>
        </tbody>
    </table>

    <h3 style="color: red;">@lang('invoice.pay-in-2-weeks')</h3><br>
    <p>@lang('invoice.due-date'): {{date("d.m.Y", $due)}}</p>

@stop