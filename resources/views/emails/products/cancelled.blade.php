<x-mail::message>
# Introduction

Dear **{{ $user->name }}**,
    
Your access for {{ $message }} is cancelled.


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
