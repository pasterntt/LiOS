@extends('dashboard.layout')
@section('content')
    @if(DB::table('shop_items')->where('active', 1)->count() >0)
    <ul class="cd-gallery">
        @foreach($shop_items as $item)
            <li>
                @if($item->sold < 10)
                    <span class="cd-sale bg-success">New</span>
                @endif
                    @if($item->discount !=0)
                        <span class="cd-sale bg-danger">-{{$item->discount}}%</span>
                    @endif
                <a href="#">
                    <ul class="cd-item-wrapper">
                        <li class="selected" @if($item->discount !=0) data-sale="true" data-price="{{number_format(round($item->price*(1-$item->discount/100),2),2)}}€" @endif>
                            <img src="{{$item->image}}" alt="Preview image">
                        </li>
                    </ul>
                <div class="cd-item-info">
                    <b><a href="{{URL::to('shop/product/'.$item->id)}}" title="{{$item->title}}">{{$item->title}}</a></b>
                    <em class="cd-price">{{$item->price}}€</em> <br>/ @lang('dates.month')
                    @if($item->stock < 5)) <p class="text-danger">@lang('shop.low-stock')</p> @endif
                </div>
                <div class="cd-item-details">
                    <a href="{{URL::to('shop/product/'.$item->id)}}" class="pull-left details" target="_blank"><i class="fa fa-list-ul"></i>Details</a>
                </div>
            </li>
        @endforeach
    </ul>
    <div style="text-align: center;" >
        {!! $shop_items->links() !!}
    </div>
    @else
        <div class="alert alert-info" role="alert">
            @lang('shop.nothing_available')
        </div>
    @endif
@stop