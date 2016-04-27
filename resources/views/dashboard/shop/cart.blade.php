@extends('dashboard.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <table class="table table-bordered">
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
                                <th>
                                    @lang('shop.cart.product.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cart_items as $key=>$cart_item)
                                <tr>
                                    <td>{{$cart_item['name']}}</td>
                                    <td>{{$cart_item['datacenter']->name}} ({{$cart_item['datacenter']->city}},{{$cart_item['datacenter']->country}})</td>
                                    <td>{{$cart_item['price']}}€</td>
                                    <td><a href="{{URL::to('cart/delete/'.$key)}}"
                                           class="btn btn-danger btn-xs">@lang('shop.cart.product.remove') </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right">
                        <h4 class="no-m m-t-sm">@lang('shop.cart.excl_tax')</h4>
                        <h2 class="no-m">{{number_format(round(($total/119*100),2),2)}}€</h2>
                        <br>
                        <h4 class="no-m m-t-sm">@lang('shop.cart.tax')</h4>
                        <h2 class="no-m">{{number_format(round($total/119*19,2),2)}}€</h2>
                        <br>
                        <h4 class="no-m m-t-md text-success">@lang('shop.cart.total')</h4>
                        <h1 class="no-m text-success">{{$total}}€</h1>
                        <br>
                        <a href="checkout/" class="btn btn-primary">@lang('shop.order')</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop