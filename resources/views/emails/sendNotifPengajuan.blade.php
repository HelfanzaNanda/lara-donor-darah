@component('mail::message')
# Halo {{ $user->nama }}

Selamat datang.

Pengajuan jadwal {{$pengajuan->nama_tempat}} anda telah di {{$pengajuan->status}} oleh Admin.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
