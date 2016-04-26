@extends("emails.layout")
@section("content")

    @lang("email.new_invoice")
    <br><br>
    @lang("invoice.created-date"): {{date("d.m.Y", $creation)}}<br>
    @lang("invoice.due-date"): {{date("d.m.Y", $duedate)}}<br>
    @lang("invoice.total"): {{$total}}€<br>

@stop