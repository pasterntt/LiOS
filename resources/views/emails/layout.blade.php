<head>
    <style>
        * {
            font-family: Courier, "Courier new", monospace;
        }
    </style>
</head>

@lang('email.greet_client', ["name"=>$user->name])
<br>

@lang("email.thanks_for_beeing_client")<br>
@yield("content")
<br><br>
@lang("email.greetings")<br>
---<br>
{{env("FROM_NAME")}}<br>
{{env("FROM_ADRESS")}}<br>
