@component('mail::message')
# Halo {{ $user->nama }}

Password akun anda adalah <b> {{$user->password}} .</b> Jangan berikan pada siapapun.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
