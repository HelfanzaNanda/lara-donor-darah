@component('mail::message')
# Halo {{ $user->nama }}

Selamat Siang.

Terimakasih atas partisipasi {{$user->nama}}, untuk ikut melakukan donor darah ini.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
