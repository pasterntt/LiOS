@extends('dashboard.layout')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-white">
                <div class="panel-body">
                    <img src="{{$product->image}}" style="width: 100%;" alt="Product Image">
                </div>
            </div>
            <?php
                    $data = json_decode($product->description, true);

                    ?>
            <div class="panel panel-white">
                <div class="panel-body">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">@lang('shop.products.description')</a></li>
                            <li role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">@lang('shop.products.details')</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="description">
                                <h3>@lang('shop.products.about')</h3>
                                <hr>

                                {{$data['description']}}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="details">
                                <table class="table">
                                    <tbody>
                                    @foreach($data['details'] as $detail)
                                        <tr>
                                            <th>{{$detail['name']}}</th>
                                            <td>{{$detail['value']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-white">
                <!--<div class="panel panel-white" data-spy="affix" data-offset-top="60">-->
                <div class="panel-body">
                    <p class="no-s"><h3>@lang('shop.products.buy_item')</h3></p>
                    <hr>
                    <h4 data-toggle="tooltip" data-placement="left" title="@lang('shop.products.avail_datacenter')">@lang('shop.products.availability')</h4>
                    <div class="row">
                        <div class="col-lg-1">
                            <div class="available @if($product->stock < 5 && $product->stock != 0)low @endif @if($product->stock == 0) not @endif"></div>
                        </div>
                        <div class="col-lg-10">
                            <p>@if($product->stock < 5 && $product->stock != 0) @lang('shop.products.low') @elseif($product->stock == 0) @lang('shop.products.none') @else @lang('shop.products.available')  @endif</p>
                        </div>
                    </div>
                    @if($product->active)
                    <form action="{{URL::to('cart/add')}}" method="post">
                        <input type="hidden" name="return" value="{{$product->id}}">
                        {{csrf_field()}}
                        <h4  data-toggle="tooltip" data-placement="left" title="@lang('shop.products.more_on_datacenter')">@lang('shop.products.choose_datacenter')</h4>
                        <select name="datacenter" class="form-control">
                            @foreach(DB::table('servers_datacenters')->where('active', 1)->where($product->type, 1)->get() as $datacenter)
                                <option value="{{$datacenter->id}}">{{$datacenter->name}} ({{$datacenter->city}}, {{$datacenter->country}}) @if($datacenter->additional != 0) +{{$datacenter->additional}}% @endif</option>
                            @endforeach
                        </select>

                        <h4>@lang('shop.products.payment_cycle')</h4>
                        <?php
                            $data = json_decode($product->leasetimes, true);
                        ?>
                        <select class="form-control" name="month">
                            @foreach($data as $month)
                                <option value="{{$month['months']}}">{{$month['months']}} @lang('shop.products.months') @if($month['discount'] != 0) -{{$month['discount']}}% @endif</option>
                            @endforeach

                        </select>
                        <h4>@lang('shop.products.amount')</h4>
                        <input type="text" class="form-control" name="amount" value="1" required>
                        
                        <input type="hidden" value="{{$product->id}}" name="product">
                        @if($product->discount == 0)

                        <h3>@lang('shop.total_each')</h3>
                        <h1>{{$product->price}}€</h1>
                        @else
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>@lang('shop.regular')</th>
                                        <td>{{$product->price}}€</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('shop.discount')</th>
                                        <td>{{$product->discount}}%</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h3>@lang('shop.total_each'): </h3>
                                <h2>{{number_format(round($product->price*(1-$product->discount/100),2),2)}}€</h2>

                        @endif
                        <hr>
                        <input type="submit" value="@lang('shop.add_to_cart')" class="btn btn-success">
                    </form>
                    @else
                        <div class="alert alert-danger">
                            @lang('shop.products.inactive')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop