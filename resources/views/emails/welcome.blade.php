@component('mail::message')
Welcome to our Company
@component('mail::button', ['url' => ''])
Go
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
