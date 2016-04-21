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
    </style>
</head>
<body>
<table style="width:100%;">
    <tr>
        <td style="width: 75%;">
            <p class="from">{{env("FROM_NAME")}} | {{env("FROM_ADRESS")}}</p>
            <p><b>To:</b><br>
                Tim Pasternak<br>
                Mannheimer Str. 132<br>
                04209 Leipzig<br>
                GERMANY</p>
        </td>
        <td width="25%">
            <p><b>@lang('documents.date'):</b> {{$creation}}</p>
        </td>
    </tr>
</table>
<br>
<br>
<br>
@yield('content')
</body>
</html>