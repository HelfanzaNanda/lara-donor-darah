<html>
<head>
	<title>Laporan Jadwal Batal</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Jadwal Batal</h4>
	</center>
 
	<table class='table table-bordered'>
        <thead>
            <tr>
            <th width="10">No</th>
            <th width="150">Nama Lokasi</th>
            <th>Hari, Tanggal</th>
            <th>Waktu</th>
            <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batal as $jb)
            <tr>
            <th width="10">{{$loop->iteration}}</th>
            <th width="150">{{$jb->nama_tempat}}</th>
            <th>{{$jb->hari}}, {{$jb->tanggal}}</th>
            <th>{{$jb->jam_mulai}} - {{$jb->jam_selesai}}</th>
            <th>{{$jb->alamat}}</th>
            </tr>
            @endforeach
        </tbody>
	</table>
</body>
</html>