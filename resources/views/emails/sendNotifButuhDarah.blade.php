@component('mail::message')
# Halo {{ $user->nama }}

Selamat datang.

Dibutuhkan golongan darah {{$goldar->nama}}, bagi pendonor yang bersedia untuk mendonorkan darahnya bisa segera datang ke kantor PMI untuk melakukan donor darah.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
