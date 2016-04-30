<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        * {
            font-family: 'Open Sans', sans-serif;

        }

        p {
            font-size: 11px;
        }

        .from {
            font-size: 8px;
            padding-top: 100px;
        }

        h1 {
            font-size: 22px;
        }

        .copy {
            font-size: 30px;
            color: red;
            padding-left: 3px;
        }
    </style>
</head>
<body>
<table style="width:100%;">
    <tr>
        <td style="width: 75%;">
            <p class="from">{{env("FROM_NAME")}} | {{env("FROM_ADRESS")}}</p>
            <p><b>To:</b><br>
                {{$contact->first}}  {{$contact->last}}<br>
                {{Crypt::decrypt($contact->street)}} {{Crypt::decrypt($contact->number)}}<br>
                {{Crypt::decrypt($contact->city)}}<br>
                {{Crypt::decrypt($contact->country)}}</p>
        </td>
        <td style="width: 25%;">
            <p><b>@lang('documents.date'):</b> {{$creation}}</p>
            @if(!empty($copy) && $copy)
                <h1 class="copy">@lang('documents.copy')</h1>
            @endif
        </td>
    </tr>
</table>
<br>
<br>
<br>
@yield('content')
</body>
</html>