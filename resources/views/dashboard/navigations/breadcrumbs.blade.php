<div class="page-breadcrumb">
    <ol class="breadcrumb container">
        <li><a href="{{URL::to('dashboard')}}">@lang('navigation.home')</a></li>
        @foreach($breadcrumbs as $breadcrumb)
            <li><a href="{{URL::to($breadcrumb['url'])}}">@lang($breadcrumb['title'])</a> </li>
        @endforeach
    </ol>
</div>