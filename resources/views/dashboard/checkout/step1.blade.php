@extends('dashboard.layout')

@section('content')

    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div id="rootwizard">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-user m-r-xs"></i>Personal Info</a></li>
                                <li role="presentation"><a href="#tab2" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Product Info</a></li>
                                <li role="presentation"><a href="#tab3" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Payment</a></li>
                            </ul>


                            <div class="progress progress-sm m-t-sm">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                </div>
                            </div>
                            <form id="wizardForm" method="post" action="{{URL::to('checkout/do')}}">
                                <div class="tab-content">
                                    <div class="tab-pane active fade in" id="tab1">
                                        <div class="row m-b-lg">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <h3>@lang('checkout.createcontact')</h3>
                                                    {{csrf_field()}}
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputName">@lang('checkout.firstname')</label>
                                                        <input type="text" class="form-control" name="orderFirstname" id="orderFirstname" placeholder="@lang('checkout.firstname')" value="">
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <label for="exampleInputName2">@lang('checkout.lastname')</label>
                                                        <input type="text" class="form-control col-md-6" name="orderLastname" id="orderLastname" placeholder="@lang('checkout.lastname')" value="">
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label for="exampleInputEmail">@lang('checkout.street')</label>
                                                        <input type="text" class="form-control" name="orderStreet" id="orderStreet" placeholder="@lang('checkout.street')" >
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="exampleInputEmail">@lang('checkout.streetnumber')</label>
                                                        <input type="text" class="form-control" name="orderStreetnumber" id="orderStreetnumber" placeholder="@lang('checkout.streetnumber')" >
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="exampleInputPassword1">@lang('checkout.zip')</label>
                                                        <input type="text" class="form-control" name="orderZIP" id="orderZIP" placeholder="@lang('checkout.zip')" >
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label for="exampleInputPassword1">@lang('checkout.city')</label>
                                                        <input type="text" class="form-control" name="orderCity" id="orderCity" placeholder="@lang('checkout.city')" >
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputPassword2">@lang('checkout.country')</label>
                                                        <input type="text" class="form-control" name="orderCountry" id="orderCountry" placeholder="@lang('checkout.country')">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label><input type="checkbox" name="saveValue">@lang('checkout.createnewcontact') </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h3>@lang('checkout.choosecontact')</h3>
                                                <select class="form-control" id="chooseContact" name="chooseContact">
                                                    <option value="0">@lang('checkout.chooseconselect')</option>
                                                    @foreach(Contacts::where('owner', Auth::user()->id)->get() as $contact)
                                                        <option value="{{$contact->read_id}}">#{{$contact->read_id}} - {{$contact->first}} {{$contact->last}} </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        <div class="alert alert-info">@lang('checkout.checkitems')</div>
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
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cart_items as $cart_item)
                                                <tr>
                                                    <td>{{$cart_item['name']}}</td>
                                                    <td>{{$cart_item['datacenter']->name}} ({{$cart_item['datacenter']->city}},{{$cart_item['datacenter']->country}})</td>
                                                    <td>{{$cart_item['price']}}€</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab3">
                                        <div class="row">
                                            <div class="alert alert-info">
                                                @lang('checkout.invoice_created')

                                            </div>
                                            <label class="f-s-12">@lang('checkout.notice_tos'): <a href="{{URL::to('terms/AllgemeineBedingungen')}}">Allgemeine Gesch&auml;ftsbedingungen</a>,
                                                <a href="{{URL::to('terms/widerruf')}}">Widerrufsrecht</a>
                                            </label>
                                                <input type="hidden" name="cart" value="{{$cart->key}}">
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
                                                    <input type="submit" class="btn btn-success btn-lg" value="@lang('checkout.submit')">

                                            </div>
                                        </div>
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="#" class="btn btn-default">@lang('checkout.previous')</a></li>
                                        <li class="next"><a href="#" class="btn btn-default">@lang('checkout.next')</a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
@stop
