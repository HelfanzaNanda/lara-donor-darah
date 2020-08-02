@component('mail::message')
# Halo {{ $user->nama }}

Terimakasih atas partisipasi {{$user->nama}}, untuk ikut melakukan donor darah ini. Anda layak untuk melakukan donor darah.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
