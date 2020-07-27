@component('mail::message')
# Halo {{ $user->nama }}

Selamat siang.

Dibutuhkan golongan darah {{$pendonor->gol_dar}}, bagi pendonor yang bersedia untuk mendonorkan darahnya bisa segera datang ke kantor PMI untuk melakukan donor darah.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
