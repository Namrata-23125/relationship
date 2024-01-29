<x-mail::message>
# Welcome to Extratech


{{ $user->name }} Thank you for Sign in.
{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
