@component('mail::message')
# Halo {{ $user->nama }}

Terimakasih atas partisipasi {{$user->nama}}, untuk ikut melakukan donor darah ini, akan tetapi anda belum layak untuk mendonorkan darah anda.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
