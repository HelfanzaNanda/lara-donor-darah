@component('mail::message')
# Halo {{ $user->nama }}

Terimakasih atas partisipasi {{$user->nama}}, untuk ikut melakukan donor darah ini.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
