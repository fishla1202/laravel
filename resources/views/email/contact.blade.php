@component('mail::message')
# Introduction

{{ $subject }}

@component('mail::panel')
    {{ $message }}
@endcomponent

@component('mail::button', ['url' => route('contact')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
