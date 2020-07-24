<html>
<head>
	<title>Laporan Jadwal Selesai</title>
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
		<h5>Laporan Jadwal Selesai</h4>
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
            @foreach($selesai as $js)
            <tr>
            <th width="10">{{$loop->iteration}}</th>
            <th width="150">{{$js->nama_tempat}}</th>
            <th>{{$js->hari}}, {{$js->tanggal}}</th>
            <th>{{$js->jam_mulai}} - {{$js->jam_selesai}}</th>
            <th>{{$js->alamat}}</th>
            </tr>
            @endforeach
        </tbody>
	</table>
</body>
</html>